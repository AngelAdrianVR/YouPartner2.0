<template>
  <AppLayout title="Administrador">
    <div class="dark:bg-slate-900 bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>
    <!-- --------BODY START------------------- -->
    <div class="grid grid-cols-2 gap-4 py-4 px-4">
      <!-- --------PANEL 1 START------------------- -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 grid grid-cols-2 max-h-60"
      >
        <h3 class="text-indigo-500 text-center">Ingresos</h3>
        <h3 class="text-indigo-500 text-center">Egresos</h3>
        <hr class="col-span-full my-2" />

        <!-- -----------IGRESOS COL START--------------- -->
        <div class="overflow-y-auto grid grid-cols-2">
          <div>
            <ul class="text-left">
              <li>Tareas</li>
              <li>examenes</li>
              <li>taxes</li>
              <li>Tareas</li>
              <li>examenes</li>
              <li>taxes</li>
              <li>Tareas</li>
              <li>examenes</li>
              <li>taxes</li>
            </ul>
          </div>
          <div>
            <ul class="text-center">
              <li>$45,000</li>
              <li>$5,000</li>
              <li>$9,500</li>
              <li>$45,000</li>
              <li>$5,000</li>
              <li>$9,500</li>
              <li>$45,000</li>
              <li>$5,000</li>
              <li>$9,500</li>
            </ul>
          </div>
        </div>
        <!-- -----------IGRESOS COL END--------------- -->

        <!-- ---------EGRESOS COL START----------------------- -->
        <div class="overflow-y-auto grid grid-cols-2 col-start-2">
          <div>
            <ul class="text-left">
              <li class="pl-3">Tareas</li>
              <li class="pl-3">examenes</li>
              <li class="pl-3">taxes</li>
              <li class="pl-3">Tareas</li>
              <li class="pl-3">examenes</li>
            </ul>
          </div>
          <div>
            <ul class="text-center">
              <li>$45,000</li>
              <li>$5,000</li>
              <li>$9,500</li>
              <li>$45,000</li>
              <li>$5,000</li>
            </ul>
          </div>
        </div>
        <!-- -------EGRESOS COL END------------------------- -->

        <!-- ---------------------->
        <br />
        <div class="col-start-2 text-right">
          <span class="text-indigo-500"> Utilidad Bruta: </span>
        </div>
        <!-- ---------------------->
      </div>
      <!-- --------PANEL 1 END------------------- -->

      <!-- --------PANEL 2 START------------------- -->
      <div
        class="bg-white dark:text-gray-300 dark:bg-slate-800 rounded-lg shadow-md px-3 py-2 grid grid-cols-2"
      >
        tyklj
      </div>
      <!-- --------PANEL 2 END------------------- -->
    </div>
    <!-- --------BODY END------------------- -->
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import DashboardPanel from "@/Components/MyComponents/DashboardPanel.vue";
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
    DashboardPanel,
    Tabs,
    Link
  },
};
</script>
