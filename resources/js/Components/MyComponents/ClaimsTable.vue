<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="claims" />
  </div>
  <div class="overflow-x-auto text-sm px-4 dark:text-gray-300">
    <table v-if="claims.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="claim in claims.data"
          :key="claim.id"
          class="focus:outline-none h-16 border border-gray-100 dark:border-slate-800 rounded"
        >
          <td class="px-1 text-center">
            <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
          </td>
          <td class="pr-5">
            <Avatar :user="claim.collaboration.homework.user" />
          </td>
          <td>
            <div class="flex items-center pl-1">
              <p class="font-medium leading-none text-gray-700 mr-2 dark:text-gray-200">
                {{ claim.collaboration.homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-3">
            <div class="flex items-center" title="Materia">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none text-gray-600 ml-2 dark:text-gray-300">
                {{ claim.collaboration.homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-3">
            <div
              class="flex items-center"
              :class="
                unreadOwnerMessages(claim.collaboration.homework)
                  ? 'text-indigo-500'
                  : 'dark:text-gray-300 text-gray-600'
              "
              title="Mensajes de propietario de la tarea"
            >
              <i class="fa-solid fa-user-graduate"></i>
              <p class="text-sm leading-none text-gray-600 ml-1 dark:text-gray-300">
                {{
                  messagesFromSingleChat(getOwnerChat(claim.collaboration.homework))
                    .length
                }}
              </p>
            </div>
          </td>
          <td class="pl-3">
            <div
              class="flex items-center"
              :class="
                unreadCollaboratorMessages(claim.collaboration.homework)
                  ? 'text-indigo-500'
                  : 'dark:text-gray-300 text-gray-600'
              "
              title="Mensajes de colaborador"
            >
              <i class="fa-solid fa-user-tie"></i>
              <p class="text-sm leading-none text-gray-600 ml-1 dark:text-gray-300">
                {{
                  messagesFromSingleChat(
                    getCollaboratorChat(claim.collaboration.homework)
                  ).length
                }}
              </p>
            </div>
          </td>
          <td class="pl-3">
            <div class="flex items-center" title="Archivos adjuntos">
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none text-gray-600 ml-1 dark:text-gray-300">0</p>
            </div>
          </td>
          <td class="pl-3">
            <div class="flex items-center" title="Fecha de reclamo">
              <i class="fa-regular fa-calendar"></i>
              <p class="text-sm leading-none text-gray-600 ml-2 dark:text-gray-300">
                {{ claim.created_at.special }}
              </p>
            </div>
          </td>
          <td class="pl-3">
            <div
              class="rounded-full px-2 py-px dark:bg-red-300 dark:text-red-900 bg-red-100 text-red-600 text-xs"
              v-if="!claim.solution"
            >
              Abierto
            </div>
            <div
              class="rounded-full px-2 py-px dark:bg-green-300 dark:text-green-900 bg-green-100 text-green-600 text-xs"
              v-else
            >
              Cerrado
            </div>
          </td>
          <td class="pl-4">
            <button
              @click="showDetails(claim.collaboration.homework)"
              class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 text-sm leading-none text-gray-600 mr-4 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none dark:text-gray-200 dark:bg-blue-900 dark:hover:bg-blue-700"
            >
              Ver
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="text-center text-gray-500 my-3">
      No hay ningún registro para mostrar
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/MyComponents/Pagination.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import Input from "@/Components/Input.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {};
  },
  emits: ["details"],
  components: {
    ConfirmationModal,
    SecondaryButton,
    DangerButton,
    Pagination,
    Avatar,
    Input,
    Link,
  },
  props: {
    claims: Object,
  },
  methods: {
    showDetails(prop) {
      this.$emit("details", prop);
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
    unreadOwnerMessages(homework) {
      const messages = this.messagesFromSingleChat(this.getOwnerChat(homework));
      if (messages.length) {
        return messages.some((message) => !message.read_at.special);
      }
    },
    unreadCollaboratorMessages(homework) {
      const messages = this.messagesFromSingleChat(this.getCollaboratorChat(homework));
      if (messages.length) {
        return messages.some((message) => !message.read_at.special);
      }
    },
    getOwnerChat(homework) {
      let support_chats = homework.chats.filter(
        (chat) => chat.users[0].id === 3 || chat.users[1].id === 3
      );
      return support_chats.find((chat) =>
        chat.users.some((user) => user.id === homework.user.id)
      );
    },
    getCollaboratorChat(homework) {
      let support_chats = homework.chats.filter(
        (chat) => chat.users[0].id === 3 || chat.users[1].id === 3
      );
      return support_chats.find((chat) =>
        chat.users.some((user) => user.id === homework.approved_collaboration.user.id)
      );
    },
  },
};
</script>
