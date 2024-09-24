<template>
  <i
    class="fa-solid mr-1"
    :class="{
      'fa-bullseye text-red-300': status == 0,
      'fa-clock text-sky-300': status == 1,
      'fa-spinner text-amber-200': status == 2,
      'fa-check text-green-300': status == 3,
      'fa-circle-exclamation text-red-500': status == 4,
    }"
    :title="titles[status]"
  ></i>
</template>

<script>
export default {
  data() {
    return {
      titles: [
        "Sin colaboración",
        "Esperando aprobación",
        "En proceso",
        "Completado",
        "Con reclamo",
      ],
    };
  },
  props: {
    status: {
      type: Number,
      default: 0,
    },
  },
};
</script>