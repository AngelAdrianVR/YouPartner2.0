<template>
  <AppLayout title="Administrador">
    <div
      class="bg-white transition-dark dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10"
    >
      <header class="flex bg-white dark:bg-slate-900 w-full">
        <Tabs :tabs="tabs" />
      </header>
      <CollaborationAdminTable :collaborations="collaborations" @details="showDetails" />
    </div>
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
          <div v-if="collaboration_detail.bank_number" class="mt-3">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-building-columns mr-2"></i>
              <span>Datos bancarios</span>
            </h1>
            <div>
              <p class="text-sm text-gray-400">
                Número de tarjeta:
                <strong>{{ collaboration_detail.bank_number }}</strong
                ><br />
                Banco: <strong>{{ collaboration_detail.bank_name }}</strong>
              </p>
            </div>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <DropupButton
            v-if="
              !collaboration_detail.payed_at.string && collaboration_detail.bank_number
            "
          >
            <template #links>
              <span @click="show_confirmation = true" class="dropup-link"
                >Marcar como pagado</span
              >
            </template>
          </DropupButton>
          <button @click="side_modal = false" class="btn-secondary mx-2">Cerrar</button>
        </div>
      </template>
    </DetailsModal>
    <!-- confirmation -->
    <ConfirmationModal :show="show_confirmation" @close="show_confirmation = false">
      <template #title> Marcar como pagada la colaboración </template>
      <template #content>
        No olvides enviar un correo a
        <strong class="text-indigo-600 font-bold">{{
          collaboration_detail.user.email
        }}</strong>
        con la imagen comprobando el depósito.
        <div class="mt-3 w-full">
          <InputLabel class="dark:text-gray-300" value="Comprobante de pago" />
          <FileUploader @input="form.file = $event.target.files[0]" />
        </div>
      </template>
      <template #footer>
        <button class="btn-danger" @click="markAsPayed">Continuar</button>
        <button class="btn-secondary ml-2" @click="show_confirmation = false">
          Cancelar
        </button>
      </template>
    </ConfirmationModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import CollaborationAdminTable from "@/Components/MyComponents/CollaborationAdminTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    const form = useForm({
      file: null,
      collaboration_id: null,
    });

    return {
      form,
      collaboration_detail: {},
      side_modal: false,
      show_confirmation: false,
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
    CollaborationAdminTable,
    ConfirmationModal,
    AttachedFile,
    DetailsModal,
    // DropupButton,
    FileUploader,
    InputLabel,
    AppLayout,
    Avatar,
    Tabs,
  },
  props: {
    collaborations: Object,
  },
  methods: {
    showDetails(item) {
      this.collaboration_detail = item;
      this.side_modal = true;
    },
    // hideModal() {
    //   this.side_modal = false;
    // },
    markAsPayed() {
      this.show_confirmation = false;
      this.form.collaboration_id = this.collaboration_detail.id;
      this.form.post(route("collaborations.payed"), {
        onSuccess: () => {
          this.side_modal = false;
        },
      });
    },
  },
};
</script>
