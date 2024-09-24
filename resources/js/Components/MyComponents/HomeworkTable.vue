<template>
  <div class="lg:flex justify-between items-center py-1 mt-2 space-x-1">
    <!-- <InputSearch :filters="filters" :filterURL="filterURL" class="mb-2 flex-1" /> -->
    <Pagination :pagination="homeworks" />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="homeworks.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="homework in homeworks.data"
          :key="homework.id"
          class="focus:outline-none h-16 border dark:border-slate-800 border-gray-100 rounded"
        >
          <td class="px-3">
            <StatusIcon :status="homework.status" />
          </td>
          <td v-if="withAvatar" class="pr-5">
            <Avatar
              :user="homework.collaboration ? homework.collaboration.user : homework.user"
            />
          </td>
          <td>
            <div class="flex items-center pl-1">
              <p class="font-medium leading-none dark:text-gray-300 text-gray-700 mr-2">
                {{ homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div
              class="flex items-center dark:text-gray-300 text-gray-600"
              title="Materia"
            >
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none ml-2">
                {{ homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td v-if="homework.status === 4" class="pl-2">
            <div
              class="flex items-center"
              :class="
                unreadSupportMessages(homework)
                  ? 'text-indigo-500'
                  : 'dark:text-gray-300 text-gray-600'
              "
              title="Mensajes de soporte"
            >
              <i class="fa-solid fa-headset"></i>
              <p class="text-sm leading-none ml-2">
                {{ messagesFromSingleChat(getSupportChat(homework)).length }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="flex items-center"
              :class="
                unreadMessages(homework)
                  ? 'text-indigo-500'
                  : 'dark:text-gray-300 text-gray-600'
              "
              title="Mensajes de colaborador(es)"
            >
              <i class="fa-solid fa-comment-dots"></i>
              <p class="text-sm leading-none ml-2">
                {{ messagesFromMultipleChats(getChatsExcludingSupport(homework)).length }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="flex items-center dark:text-gray-300 text-gray-600"
              title="Archivos adjuntos"
            >
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none ml-2">
                {{ homework.media.length }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="flex items-center"
              :class="
                unreadCollaborations(homework)
                  ? 'text-indigo-500'
                  : 'dark:text-gray-300 text-gray-600'
              "
              title="Solicitudes de colaboración"
            >
              <i class="fa-solid fa-user"></i>
              <p class="text-sm leading-none ml-2">
                {{ homework.collaborations.length }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded font-bold"
              :class="
                homework.priority === 'Urgente'
                  ? ' text-red-700 dark:text-red-500'
                  : 'text-green-700 dark:text-green-500'
              "
              :title="'Prioridad: ' + homework.priority"
            >
              <i class="mr-2 text-lg fa-solid fa-calendar-days"></i>
              Límite: {{ homework.limit_date }}
            </div>
          </td>
          <td>
            <div v-if="homework.status === 3">
              <i
                v-if="homework.approved_collaboration.payed_at.special"
                title="Pago realizado"
                class="fa-solid fa-hand-holding-dollar text-green-600"
              ></i>
              <i
                v-else-if="homework.approved_collaboration.bank_number"
                title="Esperando pago"
                class="fa-solid fa-hand-holding-dollar text-gray-500"
              ></i>
              <i
                v-else-if="homework.approved_collaboration.payment_released_at.special"
                class="fa-solid fa-unlock-keyhole text-green-600"
                title="Pago liberado"
              ></i>
              <i
                v-if="homework.approved_collaboration.rate"
                title="Tarea calificada"
                class="fa-solid fa-star text-lg text-yellow-500 ml-5"
              ></i>
            </div>
          </td>
          <td>
            <button
              @click="showDetails(homework)"
              class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 text-sm leading-none text-gray-600 mr-4 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:text-gray-200 dark:bg-blue-900 dark:hover:bg-blue-700 focus:outline-none"
            >
              Ver
            </button>
          </td>
          <td v-if="canDelete && canEdit">
            <div class="flex items-center text-xs text-gray-300">
              <Link
                v-if="canEdit"
                :href="route('homeworks.edit', homework)"
                class="mr-2 hover:text-blue-300"
              >
                <i class="fa-solid fa-pen"></i>
              </Link>
              <button
                @click="
                  delete_confirm = true;
                  item_to_delete = homework;
                "
                v-if="canDelete"
                class="mr-2 hover:text-red-300"
              >
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="text-center text-gray-500 my-3">
      No hay ningún registro para mostrar
    </div>
  </div>
  <ConfirmationModal :show="delete_confirm" @close="delete_confirm = false">
    <template #title>
      <div>¿Deseas continuar?</div>
    </template>
    <template #content>
      <div>
        Estás a punto de eliminar una tarea, una vez realizado ya no se podrá recuperar
      </div>
    </template>
    <template #footer>
      <div class="flex justify-end">
        <button @click="this.delete()" class="btn-danger mr-2">Eliminar</button>
        <button class="btn-secondary" @click="delete_confirm = false">Cancelar</button>
      </div>
    </template>
  </ConfirmationModal>
</template>

<script>
import Pagination from "@/Components/MyComponents/Pagination.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import Input from "@/Components/Input.vue";
// // import InputSearch from "@/Components/MyComponents/InputSearch.vue";
import { Link } from "@inertiajs/vue3";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import StatusIcon from "@/Components/MyComponents/StatusIcon.vue";

export default {
  data() {
    return {
      delete_confirm: false,
      item_to_delete: {},
    };
  },
  emits: ["details"],
  components: {
    Pagination,
    Avatar,
    Input,
    // InputSearch,
    Link,
    DangerButton,
    ConfirmationModal,
    SecondaryButton,
    StatusIcon,
  },
  props: {
    homeworks: Object,
    filters: Object,
    filterURL: String,
    canEdit: Boolean,
    canDelete: Boolean,
    withAvatar: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    delete() {
      this.$inertia.delete(this.route("homeworks.destroy", this.item_to_delete));
      this.delete_confirm = false;
    },
    showDetails(prop) {
      this.$emit("details", prop);
    },
    messagesFromMultipleChats(chats) {
      let messages = [];

      if (chats.length) {
        const user_id = this.$page.props.user.id;
        chats.forEach(function (chat) {
          chat.messages.forEach(function (message) {
            if (message.user.id != user_id) messages.push(message);
          });
        });
      }

      return messages;
    },
    messagesFromSingleChat(chat) {
      let messages = [];

      if (chat != undefined) {
        const user_id = this.$page.props.user.id;
        chat.messages.forEach(function (message) {
          if (message.user.id != user_id) messages.push(message);
        });
      }

      return messages;
    },
    unreadMessages(homework) {
      const messages = this.messagesFromMultipleChats(
        this.getChatsExcludingSupport(homework)
      );
      if (messages.length) {
        return messages.some((message) => !message.read_at.special);
      }
    },
    unreadSupportMessages(homework) {
      const messages = this.messagesFromSingleChat(this.getSupportChat(homework));
      if (messages.length) {
        return messages.some((message) => !message.read_at.special);
      }
    },
    unreadCollaborations(homework) {
      if (homework.collaborations.length) {
        return homework.collaborations.some(
          (collaboration) => !collaboration.read_at.relative
        );
      }
    },
    getSupportChat(homework) {
      const auth_user_id = this.$page.props.user.id;
      let support_chats = homework.chats.filter(
        (chat) => chat.users[0].id === 3 || chat.users[1].id === 3
      );
      return support_chats.find((chat) =>
        chat.users.some((user) => user.id === auth_user_id)
      );
    },
    getChatsExcludingSupport(homework) {
      if (homework.chats.length)
        return homework.chats.filter(
          (chat) => chat.users[0]?.id !== 3 && chat.users[1]?.id !== 3
        );

      return [];
    },
  },
};
</script>
