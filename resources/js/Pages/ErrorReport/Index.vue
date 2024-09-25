<template>
  <AppLayout title="Errores y Sugerencias">
    <div class="px-8 mt-3">
      <div class="flex items-center">
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Reportar error/Dejar sugerencia
        </p>
      </div>
      <form @submit="store" class="mt-6">
        <div class="lg:grid grid-cols-2 gap-x-3 section-container dark:bg-slate-900">
          <div class="mt-3">
            <InputLabel class="dark:text-gray-300" value="Título" />
            <Input v-model="form.subject" type="text" class="input w-full" />
          </div>
          <div class="flex justify-center">
            <div>
              <div class="form-check">
                <input
                  v-model="form.is_error"
                  class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white dark:border-slate-500 dark:bg-slate-500 checked:bg-green-600 checked:border-green-600 dark:checked:bg-green-600 dark:checked:border-green-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                  type="radio"
                  name="bug"
                  id="bug"
                  value="1"
                />
                <label
                  class="form-check-label inline-block text-gray-800 dark:text-gray-300"
                  for="flexRadioDefault1"
                >
                  Reportar Error
                </label>
              </div>
              <div class="form-check">
                <input
                  v-model="form.is_error"
                  class="form-check-input appearance-none rounded-full h-4 w-4 bg-white dark:border-slate-500 dark:bg-slate-500 checked:bg-indigo-600 checked:border-indigo-600 dark:checked:bg-indigo-600 dark:checked:border-indigo-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                  type="radio"
                  name="bug"
                  id="sug"
                  value="0"
                />
                <label
                  class="form-check-label inline-block text-gray-800 dark:text-gray-300"
                  for="flexRadioDefault2"
                >
                  Dejar sugerencia
                </label>
              </div>
            </div>
          </div>
          <div class="mt-3 col-span-2">
            <InputLabel class="dark:text-gray-300" value="Descripción" />
            <textarea v-model="form.content" class="input w-full !h-20"></textarea>
          </div>
          <div class="mt-3 col-span-2 w-1/2 mx-auto">
            <InputLabel class="dark:text-gray-300" value="Archivos evidencia" />
            <FileUploader @input="form.resources = $event.target.files" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </div>
        <button type="submit" v-if="!form.processing" class="btn-primary mt-4">
          Crear
        </button>
        <p v-else class="text-sm text-gray-400 mt-4">Cargando...</p>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Input from "@/Components/Input.vue";
import InputFile from "@/Components/MyComponents/InputFile.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      subject: null,
      content: null,
      is_error: 1,
      resources: [],
    });

    return { form };
  },
  components: {
    FileUploader,
    InputLabel,
    AppLayout,
    InputFile,
    Input,
    Link,
  },
  props: {},
  methods: {
    store() {
      this.form.post(route("error-reports.store"));
    },
  },
};
</script>
