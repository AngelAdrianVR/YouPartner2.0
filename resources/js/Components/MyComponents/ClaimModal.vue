<template>
  <InputError />
  <div class="container mt-2">
    <h1 class="text-justify text-red-500 font-bold text-xs">
      Antes de iniciar el reclamo, asegúrate de tener evidencias y explica bien tu
      inconformidad para poder evaluar con más rapidéz tu caso. Si nos percatamos de que
      la/el colaborador(a) hizo bien su trabajo pero quieres sacar ventaja, se te
      amonestará e incluso se te podría suspender la cuenta indefinidamente.
      <a
        :href="route('terms-of-service')"
        target="_blank"
        class="text-blue-400 hover:text-blue-300"
      >
        Ver condiciones de reembolsos
      </a>
    </h1>
  </div>

  <div
    class="container flex flex-col w-full px-2 mt-2 rounded-md divide-gray-400 dark:bg-gray-900 dark:text-gray-100"
  >
    <Avatar :user="collaboration.user" secondary_info="Colaborador" />
    <form @submit.prevent="storeClaim">
      <div class="p-2 text-center">
        <textarea
          v-model="form.description"
          class="input !h-28 w-full"
          placeholder="Escribe un comentario"
        ></textarea>
      </div>
      <div class="p-2 border-b">
        <InputLabel class="dark:text-gray-300" value="Archivos o recursos testigo" />
        <FileUploader @input="form.resources = $event.target.files" />
      </div>
      <div class="text-right mt-3">
        <button class="btn-primary mx-2" v-if="!form.processing">Enviar</button>
        <button class="btn-primary mr-2" disabled v-else>
          Cargando...
          <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
        </button>
        <button type="button" class="btn-secondary mx-2" @click="$emit('cancel')">
          Cancelar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      description: null,
      resources: null,
      collaboration_id: this.collaboration.id,
    });

    return { form };
  },
  emits: ["cancel"],
  methods: {
    storeClaim() {
      this.form.post(route("claims.store"));
    },
  },
  components: {
    Avatar,
    FileUploader,
    InputLabel,
    InputError,
    Link,
  },
  props: {
    collaboration: Object,
  },
};
</script>
