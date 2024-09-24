<template>
  <AppLayout title="Editar tarea">
    <div class="px-8 mt-3">
      <div class="flex items-center">
        <Link
          :href="route('homeworks.no-collaboration')"
          class="flex items-center text-indigo-600"
        >
          <i class="fas fa-long-arrow-alt-left text-lg"></i>
          <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Editar tarea {{ form.id }}
        </p>
      </div>
      <form @submit.prevent="update" class="mt-6">
        <div class="lg:grid grid-cols-2 gap-x-3 section-container dark:bg-slate-900">
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Título" />
            <Input v-model="form.title" type="text" class="input w-full" />
          </div>
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Materia" />
            <select v-model="form.school_subject_id" class="input w-full">
              <option value="" selected>-- Seleccione --</option>
              <option
                v-for="subject in subjects"
                :key="subject.id"
                :value="subject.id"
              >
                {{ subject.name }}
              </option>
            </select>
          </div>
          <div class="mt-3 col-span-2">
            <Label class="dark:text-gray-300" value="Descripción" />
            <textarea
              v-model="form.description"
              class="input w-full !h-20"
            ></textarea>
          </div>
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Prioridad" />
            <select v-model="form.priority" class="input w-full">
              <option value="" selected>-- Seleccione --</option>
              <option value="Normal">Normal</option>
              <option value="Urgente">Urgente</option>
            </select>
          </div>
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Fecha límite de entrega" />
            <Input v-model="form.limit_date" type="date" class="input w-full" />
          </div>
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Archivos subidos" />
            <div
              class="flex flex-col"
              v-for="(file, index) in media"
              :key="file.id"
            >
              <div>
                <a
                  :href="file.original_url"
                  target="_blank"
                  class="text-sm text-indigo-500 hover:underline"
                  >{{ file.name }}
                </a>
                <button
                  type="button"
                  @click="
                    show_confirmation = true;
                    file_to_delete = index;
                  "
                  title="Remover archivo"
                >
                  <span
                    class="
                      text-gray-500
                      ml-2
                      font-bold
                      text-xs
                      hover:text-red-500
                    "
                    ><i class="fa-solid fa-trash-can"></i
                  ></span>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3">
            <Label class="dark:text-gray-300" value="Nuevos archivos o recursos de la tarea" />
            <FileUploader @input="form.resources = $event.target.files" />
            <progress
              v-if="form.progress"
              :value="form.progress.percentage"
              max="100"
            >
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </div>
        <button
          type="submit"
          v-if="!form.processing"
          class="btn-primary mt-4 mr-2"
        >
          Actualizar
        </button>
        <p v-else class="text-sm text-gray-400 mt-4">Cargando...</p>
      </form>
    </div>
    <ConfirmationModal
      :show="show_confirmation"
      @close="show_confirmation = false"
    >
      <template #title> Elimina recurso </template>
      <template #content>
        Estas a punto de eliminar un recurso subido anteriormente. ¿Deseas
        continuar?
      </template>
      <template #footer>
        <button class="btn-danger" @click="deleteFile">Si, eliminar</button>
        <button class="btn-secondary ml-2" @click="show_confirmation = false">
          Cancelar
        </button>
      </template>
    </ConfirmationModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";

export default {
  data() {
    const form = useForm({
      title: this.homework.title,
      description: this.homework.description,
      limit_date: this.homework.limit_date.split("T")[0],
      priority: this.homework.priority,
      user_id: this.$page.props.user.id,
      school_subject_id: this.homework.school_subject_id,
      resources: [],
    });

    return {
      form,
      show_confirmation: false,
      file_to_delete: null,
    };
  },
  components: {
    AppLayout,
    Input,
    DangerButton,
    ConfirmationModal,
    FileUploader,
    InputLabel,
    Link,
  },

  props: {
    subjects: Array,
    homework: Object,
    resources: Array,
    media: Array,
  },
  methods: {
    update() {
      if (this.form.resources.length)
        this.form.post(route("homeworks.update-with-resources", this.homework.id));
      else 
        this.form.put(route("homeworks.update", this.homework.id));
      // this.$inertia.post(route("homeworks.update", this.homework), {
      //   _method: "put", //support multipart/form-data request
      //   title: this.form.title,
      //   description: this.form.description,
      //   limit_date: this.form.limit_date,
      //   priority: this.form.priority,
      //   user_id: this.$page.props.user.id,
      //   school_subject_id: this.form.school_subject_id,
      //   any_resource: this.resources_form.resources.length,
      // });
    },
    // uploadResources() {
    //   this.resources_form.post(route('homework.upload-resources'))
    // },
    destroy() {
      this.form.delete(this.route("homeworks.destroy", this.homework));
    },
    deleteFile() {
      this.show_confirmation = false;
      axios
        .post(route("homeworks.delete-file"), {
          file_id: this.media[this. ].id,
          homework_id: this.homework.id
        })
        .then(() => {
          this.media.splice(this.file_to_delete, 1);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
