<template>
  <AppLayout title="Mis colaboraciones">
    <div
      class="bg-white transition-dark dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10"
    >
      <header class="flex bg-white dark:bg-slate-900 w-full">
        <Tabs :tabs="tabs" />
      </header>
      <div class="mt-12">
        <CollaborationTable
          :collaborations="collaborations"
          :filters="filters"
          filterURL="/collaborations/claims"
          @details="showDetails"
        />
      </div>
    </div>
  </AppLayout>
  <DetailsModal :show="side_modal" @close="side_modal = false">
    <template #title>
      <div class="flex flex-col">
        <h1 class="text-indigo-600 text-xl font-semibold">
          {{ collaboration_detail.homework.title }}
        </h1>
        <div class="flex justify-between">
          <small class="text-indigo-400 text-xs">
            <i class="fa-solid fa-tag"></i>
            {{ collaboration_detail.homework.school_subject.name }}
          </small>
          <div class="flex flex-col space-y-1">
            <small
              class="text-xs px-2 rounded-md"
              :class="
                collaboration_detail.homework.priority === 'Urgente'
                  ? 'text-red-700 bg-red-100 dark:text-red-900 dark:bg-red-500'
                  : 'text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500'
              "
              :title="'Prioridad: ' + collaboration_detail.homework.priority"
            >
              Límite: {{ collaboration_detail.homework.limit_date }}
            </small>
            <small
              class="text-xs px-2 rounded-md text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500"
            >
              Entregado: {{ collaboration_detail.completed_date }}
            </small>
          </div>
        </div>
      </div>
    </template>
    <template #content>
      <section class="mt-3">
        <div>
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <span>Descripción</span>
          </h1>
          <div>
            <p class="text-sm text-gray-500">
              {{ collaboration_detail.homework.description }}
            </p>
          </div>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-paperclip mr-2"></i>
            <span>Archivos adjuntos</span>
          </h1>
          <div
            v-if="collaboration_detail.homework.media.length"
            class="mt-1 flex flex-col"
          >
            <AttachedFile
              v-for="(file, index) in collaboration_detail.homework.media"
              :key="index"
              :name="file.name"
              :extension="file.mime_type.split('/')[1]"
              :href="file.original_url"
            />
          </div>
          <p v-else class="text-center text-gray-400 text-xs pt-3">
            No hay recursos para esta tarea
          </p>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-paperclip mr-2"></i>
            <span>Resultados de la tarea</span>
          </h1>
          <div class="mt-1 flex flex-col">
            <AttachedFile
              v-for="file in collaboration_detail.media"
              :key="file.id"
              :name="file.name"
              :extension="file.mime_type.split('/')[1]"
              :href="file.original_url"
            />
          </div>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>
            <span class="mr-3">Reclamo</span>
            <span
              v-if="collaboration_detail.claim.solution"
              class="rounded-full px-2 py-1 bg-green-100 text-green-600 text-xs dark:text-green-900 dark:bg-red-500"
              >Cerrado</span
            >
            <span
              v-else
              class="rounded-full px-2 py-px bg-red-100 text-red-600 text-xs dark:text-black dark:bg-red-500"
              >Abierto</span
            >
          </h1>
          <div class="mt-1 flex flex-col">
            <ClaimView :collaboration="collaboration_detail" />
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
              >Chatear con propietario de tarea</span
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
          {{ collaboration_detail.homework.title }}
        </p>
      </div>
    </template>
    <template #content>
      <MessagesModal :chat="chat" v-if="show_chat" />
    </template>
    <template #footer></template>
  </DialogModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import CollaborationTable from "@/Components/MyComponents/CollaborationTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import ClaimView from "@/Components/MyComponents/ClaimView.vue";
import DialogModal from "@/Components/DialogModal.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      collaboration_detail: {},
      chat: null,
      dialog_modal: false,
      show_chat: false,
      show_send_homework: false,
      side_modal: false,
      show_confirmation: false,
      tabs: [
        {
          label: "Disponibles",
          url: "collaborations.index",
        },
        {
          label: "Esperando aprobación",
          url: "collaborations.approve-pendent",
        },
        {
          label: "En proceso",
          url: "collaborations.in-process",
        },
        {
          label: "Completados",
          url: "collaborations.completed",
        },
        {
          label: "Reclamos",
          url: "collaborations.claims",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    Tabs,
    CollaborationTable,
    DetailsModal,
    // DropupButton,
    MessagesModal,
    DialogModal,
    AttachedFile,
    ClaimView,
  },
  props: {
    collaborations: Object,
    filters: Object,
  },
  methods: {
    showDetails(item) {
      this.collaboration_detail = item;
      this.side_modal = true;
    },
    showChat() {
      this.show_chat = true;
      this.dialog_modal = true;
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
          this.collaboration_detail.homework.chats = [response.data];
          this.chat = response.data;
          this.showChat();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    searchChatwithOwner() {
      const auth_user_id = this.$page.props.user.id;
      if (this.collaboration_detail.homework.chats.length) {
        return this.collaboration_detail.homework.chats.find((chat) =>
          chat.users.some((user) => user.id === auth_user_id)
        );
      }
      return undefined;
    },
    async createChat() {
      try {
        const response = await axios.post(route("chat.store"), {
          chat_mate_id: this.collaboration_detail.user.id,
          homework_id: this.collaboration_detail.homework.id,
        });
        this.chat = response.data;
        this.collaboration_detail.homework.chats = [response.data];
        this.showChat();
      } catch (error) {
        console.log(error);
      }
    },
    searchChatwithSupport() {
      const auth_user_id = this.$page.props.user.id;
      if (this.collaboration_detail.homework.chats.length) {
        let support_chats = this.collaboration_detail.homework.chats.filter(
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
          homework_id: this.collaboration_detail.homework.id,
        });
        this.chat = response.data;
        this.collaboration_detail.homework.chats = [response.data];
        this.showChat();
      } catch (error) {
        console.log(error);
      }
    },
    hideModal() {
      this.show_send_homework = false;
      this.show_chat = false;
      this.show_support_chat = false;
      this.dialog_modal = false;
    },
  },
};
</script>
