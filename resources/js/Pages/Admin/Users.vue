<template>
  <AppLayout title="Administrador">
    <div class="dark:bg-slate-900 bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>

  <div class="overflow-y-auto max-h-[85%]">
    <UsersTable :users="users" />
  </div>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import UsersTable from "@/Components/MyComponents/UsersTable.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      tabs: [
        {
          label: "Finanzas",
          url: "admin.finances",
        },
        {
          label: "Configuraciones",
          url: "admin.configurations",
        },
        {
          label: "Reclamos",
          url: "admin.claims",
        },
        {
          label: "Colaboraciones",
          url: "admin.collaborations",
        },
        {
          label: "Notificaciones",
          url: "admin.notifications",
        },
        {
          label: "Usuarios",
          url: "admin.users",
        },
        {
          label: "Errores/Sugerencias",
          url: "admin.errors",
        },
      ],
    };
  },
  components: {
    AppLayout,
    UsersTable,
    Tabs,
    Link
  },
  props:{
    users: Object,
  }
};
</script>
