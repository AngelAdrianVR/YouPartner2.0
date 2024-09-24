<template>
  <div class="mt-1">
    <div
      class="border rounded-md border-dotted max-h-[35vh] min-h-[10vh] overflow-y-auto px-1 py-2 divide-y"
    >
      <div
        @click="openCollaborationApplicant(item, index)"
        v-for="(item, index) in collaborations"
        :key="item"
        class="grid grid-cols-2 gap-x-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer rounded"
        :class="{
          'border-l-4 border-l-indigo-500 bg-indigo-50 hover:bg-indigo-100 dark:bg-slate-800 font-bold': !item
            .read_at.relative,
        }"
      >
        <Avatar :user="item.user" :secondary_info="item.created_at.relative" />
      </div>
      <p
        v-if="!collaborations.length"
        class="text-center dark:text-gray-300 text-gray-400 text-xs pt-3"
      >
        No tienes ninguna solicitud
      </p>
    </div>
  </div>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";

export default {
  props: {
    collaborations: Array,
  },
  emits: ["showApplicant"],
  components: {
    Avatar,
  },
  methods: {
    openCollaborationApplicant(item, index) {
      if (item.read_at.string === null) {
        axios
          .post(route("collaborations.read-collaboration"), {
            collaboration_id: item.id,
          })
          .then((response) => {
            this.collaborations[index] = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
      this.$emit("showApplicant", item);
    },
  },
};
</script>
