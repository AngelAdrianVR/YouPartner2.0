<template>
  <form @submit.prevent="sendHomework">
    <div
      class="container flex flex-col w-full mx-auto px-4 divide-y rounded-md divide-gray-400 dark:divide-indigo-600 bg-white-600 text-gray-600"
    >
      <div class="px-4">
        <div class="flex justify-between">
          <Avatar :user="collaboration.homework.user" />
          <Avatar :user="$page.props.auth.user" />
        </div>
      </div>
      <div class="p-3 text-center">
        <textarea
          v-model="form.completed_comments"
          class="input !h-28 w-full"
          placeholder="Escribe un comentario"
        ></textarea>
        <FileUploader @input="form.resources = $event.target.files" />
      </div>
      <div class="text-right">
        <button class="btn-primary mx-2 my-4" v-if="!form.processing">Enviar</button>
        <button class="btn-primary mr-2 mt-3" disabled v-else>
          Cargando...
          <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
        </button>
        <button type="button" class="btn-secondary mx-2" @click="$emit('cancel')">
          Cancelar
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";
import RatingStars from "@/Components/MyComponents/RatingStars.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      completed_comments: null,
      resources: null,
      collaboration_id: this.collaboration.id,
    });

    return { form };
  },
  emits: ["cancel"],
  components: {
    FileUploader,
    RatingStars,
    Avatar,
  },
  props: {
    collaboration: Object,
  },
  methods: {
    sendHomework() {
      this.form.post(route("collaborations.update-p"));
    },
  },
};
</script>
