<template>
  <AppLayout title="Administrador">
    <div
      class="bg-white transition-dark dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10"
    >
      <header class="flex bg-white dark:bg-slate-900 w-full">
        <Tabs :tabs="tabs" />
      </header>
      <ClaimsTable :claims="claims" @details="showDetails" />
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
          <DropupButton>
            <template #links>
              <span @click="prepairOwnerChat" class="dropup-link"
                >Chatear con propietario de tarea</span
              >
              <span @click="prepairCollaboratorChat" class="dropup-link"
                >Chatear con colaborador</span
              >
              <span
                v-if="!homework_detail.approved_collaboration.claim.solution"
                @click="showSolutionModal"
                class="dropup-link"
                >Solucionar</span
              >
            </template>
          </DropupButton>
          <button @click="side_modal = false" class="btn-secondary mx-2">Cerrar</button>
        </div>
      </template>
    </DetailsModal>
    <DialogModal :show="dialog_modal" @close="hideModal">
      <template #title>
        <div class="flex flex-col">
          <div v-if="show_chat" class="font-bold text-gray-600">Chat</div>
          <div v-if="show_solution_modal" class="font-bold text-gray-600">
            Solución <br />
          </div>
          <p class="text-indigo-500 font-normal text-sm">
            {{ homework_detail.title }}
          </p>
        </div>
      </template>
      <template #content>
        <MessagesModal :chat="chat" v-if="show_chat" />
        <SolutionModal
          :claim="homework_detail.approved_collaboration.claim"
          :price="homework_detail.approved_collaboration.price"
          v-if="show_solution_modal"
          @cancel="hideModal"
        />
      </template>
      <template #footer></template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import ClaimsTable from "@/Components/MyComponents/ClaimsTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import ClaimView from "@/Components/MyComponents/ClaimView.vue";
import DialogModal from "@/Components/DialogModal.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";
import SolutionModal from "@/Components/MyComponents/SolutionModal.vue";

export default {
  data() {
    return {
      homework_detail: {},
      show_chat: false,
      show_solution_modal: false,
      chat: null,
      side_modal: false,
      dialog_modal: false,
      tabs: [
        {
          label: "Finanzas",
          url: "admin.finances",
        },
        {
          label: "Configuraciones",
          url: "admin.configurations",
        },
        {
          label: "Colaboraciones",
          url: "admin.collaborations",
        },
        {
          label: "Reclamos",
          url: "admin.claims",
        },
        {
          label: "Notificaciones",
          url: "admin.notifications",
        },
        {
          label: "Usuarios",
          url: "admin.users",
        },
        {
          label: "Errores/Sugerencias",
          url: "admin.errors",
        },
      ],
    };
  },
  components: {
    SolutionModal,
    MessagesModal,
    AttachedFile,
    DetailsModal,
    ClaimsTable,
    // DropupButton,
    DialogModal,
    AppLayout,
    ClaimView,
    Avatar,
    Tabs,
  },
  props: {
    claims: Object,
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
    showSolutionModal() {
      this.show_solution_modal = true;
      this.dialog_modal = true;
    },
    prepairOwnerChat() {
      const chat = this.searchChatwithOwner();
      if (chat === undefined) {
        this.createChat(this.homework_detail.user.id);
      } else {
        if (this.isAnyUnread(chat.messages)) {
          this.markAsRead(chat);
        } else {
          this.chat = chat;
          this.showChat();
        }
      }
    },
    prepairCollaboratorChat() {
      const chat = this.searchChatwithCollaborator();
      if (chat === undefined) {
        this.createChat(this.homework_detail.approved_collaboration.user.id);
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
      if (this.homework_detail.chats.length) {
        let support_chats = this.homework_detail.chats.filter(
          (chat) => chat.users[0].id == 3 || chat.users[1].id == 3
        );
        return support_chats.find((chat) =>
          chat.users.some((user) => user.id === this.homework_detail.user.id)
        );
      }
      return undefined;
    },
    searchChatwithCollaborator() {
      const auth_user_id = this.$page.props.user.id;
      if (this.homework_detail.chats.length) {
        let support_chats = this.homework_detail.chats.filter(
          (chat) => chat.users[0].id == 3 || chat.users[1].id == 3
        );
        return support_chats.find((chat) =>
          chat.users.some(
            (user) => user.id === this.homework_detail.approved_collaboration.user.id
          )
        );
      }
      return undefined;
    },
    async createChat(user_id) {
      try {
        const response = await axios.post(route("chat.store"), {
          chat_mate_id: user_id,
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
      this.show_chat = false;
      this.show_solution_modal = false;
      this.dialog_modal = false;
    },
  },
};
</script>
