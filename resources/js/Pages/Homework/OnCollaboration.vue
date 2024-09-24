<template>
  <AppLayout title="Mis tareas en colaboración">
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
        filterURL="/homeworks/on-collaboration"
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
            <small
              class="text-xs px-2 rounded-md"
              :class="
                homework_detail.priority === 'Urgente'
                  ? 'text-red-700 bg-red-100 dark:text-red-900 dark:bg-red-500'
                  : 'text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500'
              "
              :title="'Prioridad: ' + homework_detail.priority"
            >
              Entrega: {{ homework_detail.limit_date }}
            </small>
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
                {{ homework_detail.description }}
              </p>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span>Colaborador</span>
            </h1>
            <Avatar
              :user="homework_detail.approved_collaboration.user"
              :secondary_info="
                'Promete entregar el: ' +
                homework_detail.approved_collaboration.promise_date
              "
            />
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
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
              No hay recursos para esta tarea
            </p>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <button @click="prepairChat" class="btn-primary">Mensajes</button>
          <button @click="side_modal = false" class="btn-secondary mx-2">Cerrar</button>
        </div>
      </template>
    </DetailsModal>
    <!-- Modal -->
    <DialogModal
      :show="dialog_modal"
      @close="
        dialog_modal = false;
        show_chat = false;
      "
    >
      <template #title>
        <div v-if="show_chat" class="font-bold dark:text-gray-300 text-gray-600">
          Mensajes <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
      </template>
      <template #content>
        <MessagesModal :chat="chat" v-if="show_chat" />
      </template>
      <template #footer></template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import HomeworkTable from "@/Components/MyComponents/HomeworkTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      dialog_modal: false,
      show_chat: false,
      chat: null,
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
    HomeworkTable,
    MessagesModal,
    DetailsModal,
    AttachedFile,
    DialogModal,
    Avatar,
    Link,
    Tabs,
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
    hideModal() {
      this.show_collaborate = false;
      this.show_chat = false;
      this.dialog_modal = false;
    },
  },
};
</script>
