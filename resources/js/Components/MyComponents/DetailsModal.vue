<script setup>
import SideModal from "@/Components/SideModal.vue";

const emit = defineEmits(["close"]);

defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: "lg",
  },
  closeable: {
    type: Boolean,
    default: true,
  },
});

const close = () => {
  emit("close");
};
</script>

<template>
  <SideModal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
    <div class="">
      <div class="flex justify-end px-1 dark:bg-slate-900">
        <button
          @click="close"
          class="ml-auto text-gray-400 hover:text-red-400 hover:bg-gray-200 dark:hover:text-red-600 dark:hover:bg-gray-800 w-8 h-8 rounded-full transition-colors duration-200"
        >
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="text-lg min-h-[3rem] px-6">
        <slot name="title" />
      </div>

      <div class="overflow-y-auto h-[calc(100vh-9rem)] px-6">
        <slot name="content" />
      </div>

      <div class="px-8 h-12">
        <slot name="footer" />
      </div>
    </div>
  </SideModal>
</template>
