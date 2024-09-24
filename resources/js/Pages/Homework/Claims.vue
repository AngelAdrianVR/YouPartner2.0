<template>
  <AppLayout title="Mis tareas terminadas">
    <div
      class="bg-white transition-dark dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10"
    >
      <header class="flex bg-white dark:bg-slate-900 w-full">
        <Tabs :tabs="tabs" />
      </header>
      <div class="flex justify-end mt-4">
        <Link :href="route('homeworks.create')" class="btn-primary"> + Crear </Link>
      </div>
      <HomeworkTable
        :homeworks="homeworks"
        :filters="filters"
        filterURL="/homeworks/claims"
        @details="showDetails"
      />
    </div>
    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <div class="flex flex-col">
          <h1 class="text-indigo-600 text-xl font-semibold">
            {{ homework_detail.title }}
          </h1>
          <div class="flex justify-between">
            <small class="text-indigo-400 text-xs">
              <i class="fa-solid fa-tag"></i>
              {{ homework_detail.school_subject.name }}
            </small>
            <div class="flex flex-col space-y-1">
              <small
                class="text-xs px-2 rounded-md"
                :class="
                  homework_detail.priority === 'Urgente'
                    ? 'text-red-700 bg-red-100'
                    : 'text-green-700 bg-green-100'
                "
                :title="'Prioridad: ' + homework_detail.priority"
              >
                Límite: {{ homework_detail.limit_date }}
              </small>
              <small class="text-xs px-2 rounded-md text-green-700 bg-green-100">
                Entregado:
                {{ homework_detail.approved_collaboration.completed_date }}
              </small>
            </div>
          </div>
        </div>
      </template>
      <template #content>
        <section class="mt-3">
          <div>
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span>Descripción</span>
            </h1>
            <div>
              <p class="text-sm text-gray-500">
                {{ homework_detail.description }}
              </p>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span class="mr-5">Colaborador</span>
            </h1>
            <Avatar
              :user="homework_detail.approved_collaboration.user"
              :secondary_info="
                'Entregó el: ' + homework_detail.approved_collaboration.completed_date
              "
            />
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Archivos adjuntos</span>
            </h1>
            <div v-if="homework_detail.media.length" class="mt-1 flex flex-col">
              <AttachedFile
                v-for="(file, index) in homework_detail.media"
                :key="index"
                :name="file.name"
                :extension="file.mime_type.split('/')[1]"
                :href="file.original_url"
              />
            </div>
            <p v-else class="text-center text-gray-400 text-xs pt-3">
              No hay recursos para esta tarea <br />
            </p>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Resultados de la tarea</span>
            </h1>
            <div class="mt-1 flex flex-col">
              <AttachedFile
                v-for="file in homework_detail.approved_collaboration.media"
                :key="file.id"
                :name="file.name"
                :extension="file.mime_type.split('/')[1]"
                :href="file.original_url"
              />
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-circle-exclamation mr-2"></i>
              <span class="mr-3">Reclamo</span>
              <span
                v-if="homework_detail.approved_collaboration.claim.solution"
                class="rounded-full px-2 py-1 bg-green-100 text-green-600 text-xs"
                >Cerrado</span
              >
              <span v-else class="rounded-full px-2 py-px bg-red-100 text-red-600 text-xs"
                >Abierto</span
              >
            </h1>
            <div class="mt-1 flex flex-col">
              <ClaimView :collaboration="homework_detail.approved_collaboration" />
            </div>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <!-- <DropupButton>
            <template #links>
              <span @click="prepairSupportChat" class="dropup-link"
                >Chatear con soporte</span
              >
              <span @click="prepairChat" class="dropup-link"
                >Chatear con colaborador</span
              >
              <span @click="show_confirmation = true" class="dropup-link"
                >Cancelar reclamo</span
              >
            </template>
          </DropupButton> -->
          <button @click="side_modal = false" class="btn-secondary mx-2">Cerrar</button>
        </div>
      </template>
    </DetailsModal>
    <!-- Modal -->
    <DialogModal :show="dialog_modal" @close="hideModal">
      <template #title>
        <div class="flex flex-col">
          <div v-if="show_chat" class="font-bold text-gray-600">Chat</div>
          <p class="text-indigo-500 font-normal text-sm">
            {{ homework_detail.title }}
          </p>
        </div>
      </template>
      <template #content>
        <MessagesModal :chat="chat" v-if="show_chat" />
      </template>
      <template #footer></template>
    </DialogModal>
    <ConfirmationModal :show="show_confirmation" @close="show_confirmation = false">
      <template #title>Cancelar reclamo</template>
      <template #content> Este reclamo se eliminará, ¿desea continuar? </template>
      <template #footer>
        <button @click="deleteClaim" class="btn-danger mr-2">Continuar</button>
        <button @click="show_confirmation = false" class="btn-secondary">Cancelar</button>
      </template>
    </ConfirmationModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import HomeworkTable from "@/Components/MyComponents/HomeworkTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import DialogModal from "@/Components/DialogModal.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import ClaimView from "@/Components/MyComponents/ClaimView.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      dialog_modal: false,
      show_confirmation: false,
      show_chat: false,
      chat: null,
      side_modal: false,
      tabs: [
        {
          label: "Pendientes",
          url: "homeworks.no-collaboration",
        },
        {
          label: "En colaboracion",
          url: "homeworks.on-collaboration",
        },
        {
          label: "Terminados",
          url: "homeworks.completed",
        },
        {
          label: "Reclamos",
          url: "homeworks.claims",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    Tabs,
    HomeworkTable,
    DetailsModal,
    Avatar,
    DialogModal,
    ConfirmationModal,
    AttachedFile,
    MessagesModal,
    // DropupButton,
    ClaimView,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods: {
    showDetails(item) {
      this.homework_detail = item;
      this.side_modal = true;
    },
    showChat() {
      this.show_chat = true;
      this.dialog_modal = true;
    },
    deleteClaim() {
      try {
        this.$inertia.delete(
          route("claims.destroy", this.homework_detail.approved_collaboration.claim.id)
        );
        this.show_confirmation = false;
        this.side_modal = false;
      } catch (error) {
        console.log(error);
      }
    },
    prepairChat() {
      const chat = this.searchChatwithOwner();
      if (chat === undefined) {
        this.createChat();
      } else {
        if (this.isAnyUnread(chat.messages)) {
          this.markAsRead(chat);
        } else {
          this.chat = chat;
          this.showChat();
        }
      }
    },
    prepairSupportChat() {
      const chat = this.searchChatwithSupport();
      if (chat === undefined) {
        this.createSupportChat();
      } else {
        if (this.isAnyUnread(chat.messages)) {
          this.markAsRead(chat);
        } else {
          this.chat = chat;
          this.showChat();
        }
      }
    },
    excludeMyMessages(messages) {
      return messages.filter((message) => message.user.id !== this.$page.props.user.id);
    },
    isAnyUnread(messages) {
      if (messages.length) {
        return this.excludeMyMessages(messages).some(
          (message) => !message.read_at.special
        );
      }
    },
    markAsRead(chat) {
      axios
        .post(route("chat.read-message"), {
          chat_id: chat.id,
        })
        .then((response) => {
          this.homework_detail.chats = [response.data];
          this.chat = response.data;
          this.showChat();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    searchChatwithOwner() {
      const auth_user_id = this.$page.props.user.id;
      if (this.homework_detail.chats.length) {
        return this.homework_detail.chats.find((chat) =>
          chat.users.some((user) => user.id === auth_user_id)
        );
      }
      return undefined;
    },
    async createChat() {
      try {
        const response = await axios.post(route("chat.store"), {
          chat_mate_id: this.homework_detail.approved_collaboration.user.id,
          homework_id: this.homework_detail.id,
        });
        this.chat = response.data;
        this.homework_detail.chats = [response.data];
        this.showChat();
      } catch (error) {
        console.log(error);
      }
    },
    searchChatwithSupport() {
      const auth_user_id = this.$page.props.user.id;
      if (this.homework_detail.chats.length) {
        let support_chats = this.homework_detail.chats.filter(
          (chat) => chat.users[0].id == 3 || chat.users[1].id == 3
        );
        return support_chats.find((chat) =>
          chat.users.some((user) => user.id === auth_user_id)
        );
      }
      return undefined;
    },
    async createSupportChat() {
      try {
        const response = await axios.post(route("chat.store"), {
          chat_mate_id: 3,
          homework_id: this.homework_detail.id,
        });
        this.chat = response.data;
        this.homework_detail.chats = [response.data];
        this.showChat();
      } catch (error) {
        console.log(error);
      }
    },
    hideModal() {
      this.show_support_chat = false;
      this.show_chat = false;
      this.dialog_modal = false;
    },
  },
};
</script>
