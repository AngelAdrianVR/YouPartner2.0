<template>
  <AppLayout title="Crear Tarea">
    <div class="px-7 mt-2">
      <div class="flex items-center">
        <Link :href="route('homeworks.no-collaboration')" class="flex items-center text-indigo-600">
        <i class="fas fa-long-arrow-alt-left text-lg"></i>
        <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Crear nueva tarea
        </p>
      </div>
      <form @submit.prevent="store" class="mt-3">
        <div class="lg:grid grid-cols-2 gap-x-3 section-container transition-dark dark:bg-slate-900">
          <div class="mt-2">
            <InputLabel class="dark:text-gray-300" value="Título" />
            <Input v-model="form.title" type="text" class="w-full input" />
          </div>
          <div class="mt-3">
            <InputLabel class="dark:text-gray-300" value="Materia" />
            <select v-model="form.school_subject_id" class="input w-full">
              <option value="" selected>-- Seleccione --</option>
              <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                {{ subject.name }}
              </option>
            </select>
          </div>
          <div class="mt-3 col-span-2">
            <InputLabel class="dark:text-gray-300" value="Descripción" />
            <textarea v-model="form.description" class="input w-full !h-20"></textarea>
          </div>
          <div class="mt-3">
            <InputLabel class="dark:text-gray-300" value="Prioridad" />
            <select v-model="form.priority" class="input w-full">
              <option value="" selected>-- Seleccione --</option>
              <option value="Normal">Normal</option>
              <option value="Urgente">Urgente</option>
            </select>
          </div>
          <div class="mt-3">
            <InputLabel class="dark:text-gray-300" value="Fecha límite de entrega" />
            <Input v-model="form.limit_date" type="date" class="input w-full" />
          </div>
          <div class="mt-3 col-span-2 w-full mx-auto">
            <InputLabel class="dark:text-gray-300 text-center" value="Archivos o recursos de la tarea" />
            <FileUploader @input="form.resources = $event.target.files" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </div>
        <button type="submit" v-if="!form.processing" class="btn-primary mt-4">
          Crear
        </button>
        <p v-else class="text-sm text-gray-400 mt-4">Cargando..</p>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import InputFile from "@/Components/MyComponents/InputFile.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import InputLabel from "@/Components/InputLabel.vue";

export default {
  data() {
    const form = useForm({
        title: null,
        description: null,
        limit_date: null,
        priority: "",
        user_id: this.$page.props.auth.user.id,
        school_subject_id: "",
        resources: null,
      })

      return {form}
  },
  components: {
    AppLayout,
    Input,
    InputFile,
    FileUploader,
    InputLabel,
    Link,
  },

  props: {
    subjects: Array,
  },
  methods: {
    store() {
      this.form.post(this.route('homeworks.store'));
    },
  }
};
</script>
