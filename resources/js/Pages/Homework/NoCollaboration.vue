<template>
  <AppLayout title="Tareas">
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
        filterURL="/homeworks/no-collaboration"
        canEdit
        canDelete
        @details="showDetails($event)"
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
          <div class="mt-5">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-comment-dots mr-2"></i>
              <span>Preguntas y comentarios</span>
            </h1>
            <ChatList :chats="homework_detail.chats" @showChat="showChat($event)" />
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span>Solicitudes de colaboración</span>
            </h1>
            <CollaborationApplicants
              :collaborations="homework_detail.collaborations"
              @showApplicant="showApplicant($event)"
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
          <Link :href="route('homeworks.edit', homework_detail)" class="btn-primary"
            >Editar
          </Link>
          <button @click="side_modal = false" class="btn-secondary mx-1">Cerrar</button>
        </div>
      </template>
    </DetailsModal>
    <!-- Modal -->
    <DialogModal
      :show="dialog_modal"
      @close="
        dialog_modal = false;
        show_applicants = false;
        show_chat = false;
        show_payment = false;
      "
    >
      <template #title>
        <div v-if="show_chat" class="font-bold text-gray-600">
          Mensajes <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
        <div v-else-if="show_applicants" class="font-bold text-gray-600">
          Aplicantes a colaborar <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
        <!-- <div v-else-if="show_payment" class="font-bold text-gray-600">
          Pagar colaboración <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div> -->
      </template>
      <template #content>
        <MessagesModal :chat="chat_to_show" v-if="show_chat" />
        <CollaborationModal
          :collaboration="applicant_collaboration"
          v-else-if="show_applicants"
          @accepted="showPayment"
        />
        <!-- <PaymentModal
          :collaboration="applicant_collaboration"
          v-else-if="show_payment"
          @cancel="show_payment = false; show_applicants = true"
        /> -->
      </template>
      <template #footer></template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import HomeworkTable from "@/Components/MyComponents/HomeworkTable.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";
import CollaborationModal from "@/Components/MyComponents/CollaborationModal.vue";
import CollaborationApplicants from "@/Components/MyComponents/CollaborationApplicants.vue";
import ChatList from "@/Components/MyComponents/ChatList.vue";
// import PaymentModal from "@/Components/PaymentModal.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      dialog_modal: false,
      show_applicants: false,
      show_chat: false,
      applicant_collaboration: null,
      chat_to_show: null,
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
    CollaborationApplicants,
    CollaborationModal,
    HomeworkTable,
    MessagesModal,
    DetailsModal,
    AttachedFile,
    // PaymentModal,
    DialogModal,
    ChatList,
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
    showChat(item) {
      this.chat_to_show = item;
      this.dialog_modal = true;
      this.show_chat = true;
    },
    showApplicant(item) {
      this.applicant_collaboration = item;
      this.dialog_modal = true;
      this.show_applicants = true;
    },
    showPayment() {
      this.show_applicants = false;
      this.show_payment = true;
    },
  },
};
</script>
