<template>
  <div>
    <p class="text-sm dark:text-gray-300">
      <strong v-if="collaboration.homework"
        >{{ collaboration.homework.user.name }} -</strong
      >
      <strong class="dark:text-gray-300" v-else>Usted -</strong>
      {{ collaboration.claim.created_at.special }}
    </p>
    <p style="white-space: pre-line" class="text-xs dark:text-gray-500">
      {{ collaboration.claim.description }}
    </p>
    <div class="my-3 flex flex-col">
      <h1 class="text-gray-700 dark:text-gray-400 font-bold">Recursos testigos</h1>
      <AttachedFile
        v-for="file in collaboration.claim.media"
        :key="file.id"
        :name="file.name"
        :extension="file.mime_type.split('/')[1]"
        :href="file.original_url"
      />
      <p v-if="!collaboration.claim.media.length" class="text-xs dark:text-gray-500">No adjuntó ningun archivo</p>
    </div>
    <div v-if="collaboration.claim.solution">
      <p class="text-sm dark:text-gray-300">
        <strong>Soporte</strong> -
        {{ collaboration.claim.updated_at.special }}
      </p>
      <p style="white-space: pre-line" class="text-xs dark:text-gray-500">
        {{ collaboration.claim.solution_details }}
      </p>
      <br />
      <strong class="text-sm dark:text-gray-300">Solución -</strong>
      <p class="text-indigo-600 px-2 text-sm">{{ collaboration.claim.solution }}</p>
    </div>
    <p v-else class="text-sm mt-3 dark:text-gray-500">
      Estamos evaluando el caso. Cuando tengamos una solución te avisaremos.
    </p>
  </div>
</template>

<script>
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";

export default {
  components: {
    AttachedFile,
  },
  props: {
    collaboration: Object,
  },
};
</script>