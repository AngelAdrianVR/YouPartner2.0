<template>
  <AppLayout title="Administrador">
    <div class="dark:bg-slate-900 bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <ErrorsTable
        :errors="errors"
        :filters="filters"
        filterURL="/errors"
        @details="showDetails($event)"
      />
    </div>
  </AppLayout>

  <DetailsModal :show="side_modal" @close="side_modal = false">
    <template #title>
      <div class="flex flex-col">
        <h1 class="text-indigo-600 text-xl font-semibold">
          {{ error_detail.is_error ? "Error Report" : "Sugestion Report" }}
        </h1>
        <div class="flex justify-between">
          <small class="text-xs px-2 rounded-md">
            Created: {{ error_detail.created_at.special }}
          </small>
        </div>
      </div>
    </template>
    <template #content>
      <section class="mt-3">
        <div>
          <Avatar :user="error_detail.user" />
          <h1 class="text-lg text-gray-600">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <span>Description</span>
          </h1>
          <div>
            <p class="text-sm text-gray-500">
              {{ error_detail.content }}
            </p>
          </div>
        </div>
        <div class="mt-6">
          <h1 class="text-lg text-gray-600">
            <i class="fa-solid fa-paperclip mr-2"></i>
            <span>Attached files</span>
          </h1>
          <div v-if="error_detail.media.length" class="mt-1 flex flex-col">
            <AttachedFile
              v-for="file in error_detail.media"
              :key="file.id"
              :name="file.name"
              :extension="file.mime_type.split('/')[1]"
              :href="file.original_url"
            />
          </div>
          <p v-else class="text-center text-gray-400 text-xs pt-3">
            there is not attached files for this report.
          </p>
        </div>
      </section>
    </template>
    <template #footer>
      <div class="flex">
        <!-- <DropupButton>
          <template #links>
            <span @click="prepairChat" class="dropup-link">Send Message</span>
            <span @click="read" class="dropup-link">Mark as read</span>
            <span @click="showCollaborate" class="dropup-link">Delete</span>
          </template>
        </DropupButton> -->
        <button @click="side_modal = false" class="btn-secondary mx-2">
          Cerrar
        </button>
      </div>
    </template>
  </DetailsModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import ErrorsTable from "@/Components/MyComponents/ErrorsTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    return {
      error_detail: {},
      side_modal: false,
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
          label: "Reclamos",
          url: "admin.claims",
        },
        {
          label: "Colaboraciones",
          url: "admin.collaborations",
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
    AppLayout,
    Tabs,
    ErrorsTable,
    DetailsModal,
    // DropupButton,
    Avatar,
    AttachedFile,
  },
  props: {
    users: Object,
    errors: Object,
  },
  methods: {
    showDetails(item) {
      this.error_detail = item;
      this.side_modal = true;
    },
    read() {
      this.$inertia.put(route('error-reports.mark-as-read', this.error_detail.id));
    },
  },
};
</script>
