<template>
  <AppLayout title="Ranking">
    <div class="bg-white py-4 dark:bg-slate-900 md:py-7 px-4 md:px-8 xl:px-10">
      <pricing-plans />
    </div>
    <h1 class="text-3xl font-semibold text-indigo-500">EN CONSTRUCCION... VIENE PRONTO</h1>
    <i class="fa-solid fa-person-digging text-[95px] text-gray-400 mt-24 ml-48"></i>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import PricingPlans from "@/Components/MyComponents/PricingPlans.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      counter: 0,
      textSize: 12,
      courses: [
        {
          id: 1,
          name: "Vue.js",
          price: "$50",
        },
        {
          id: 2,
          name: "React",
          price: "$150",
        },
        {
          id: 3,
          name: "Laravel",
          price: "$200",
        },
      ],
    };
  },
  components: {
    PricingPlans,
    AppLayout,
    CursoVue,
    Tabs,
    Link
  },
  props: {},
  methods: {},
};
</script>
