<template>
  <AppLayout title="Administrador">
    <div class="dark:bg-slate-900 bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>
    <!-- --------BODY START------------------- -->
    <div class="grid grid-cols-3 gap-4 py-4 px-4">
      <!-- --------PANEL 1 COMISIONES START------------------- -->
      <div
        class="bg-white rounded-lg dark:bg-slate-800 dark:text-gray-300 shadow-md px-3 py-2 grid grid-cols-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center col-span-full">Comisiones</h3>
        <hr class="col-span-full" />

        <!-- -----------TEXTO 1 START--------------- -->
        <div>
          <ul class="text-left">
            <li class="p-2">Comision nivel 1</li>
            <li class="p-2">Comision nivel 2</li>
            <li class="p-2">Comision nivel 3</li>
            <li class="p-2">Comision nivel 4</li>
            <li class="p-2">Comision nivel 5</li>
            <li class="p-2">Comision nivel 6</li>
          </ul>
        </div>

        <!-- ---------TEXTO 1 END---------------------------- -->

        <!-- ---------VALUE 1 START---------------------------- -->
        <div class="col-start-2">
          <ul class="text-center">
            <li class="my-1"><input type="number" class="input !h-[2rem] w-28" />%</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />%</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />%</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />%</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />%</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />%</li>
          </ul>
        </div>

        <!-- ---------VALUE 1 START---------------------------- -->
        <br />
      </div>

      <!-- --------PANEL 1 COMISIONES END------------------- -->

      <!-- --------PANEL 3 RANKING START------------------- -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 grid grid-cols-3 col-span-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center col-span-full">Ranking</h3>
        <hr class="col-span-full" />

        <!-- -----------TEXTO 3 START--------------- -->
        <div>
          <ul class="text-left">
            <li class="p-2">Por Calificaciones</li>
            <li class="p-2">Por Puntos</li>
            <li class="p-2">Por Tareas Subidas</li>
            <li class="p-2">Por Colaboraciones</li>
          </ul>
        </div>

        <!-- ---------TEXTO 3 END---------------------------- -->

        <!-- ---------VALUE 3 START---------------------------- -->
        <div class="col-start-2">
          <ul class="text-center">
            <li class="my-1">
              <input type="number" class="input !h-[2rem] w-28" /> Calific. minimas
            </li>
          </ul>
        </div>
        <!-- ---------VALUE 3 END---------------------------- -->

        <!-- ---------VALUE 3 END---------------------------- -->
        <div class="col-start-3">
          <ul class="text-center">
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
          </ul>
        </div>

        <!-- ---------VALUE 3 END---------------------------- -->
      </div>
      <!-- --------PANEL 3 RANKING END------------------- -->

      <!-- --------PANEL 2 PUNTOS START------------------- -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 grid grid-cols-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center col-span-full">Puntos</h3>
        <hr class="col-span-full" />

        <!-- -----------TEXTO 2 START--------------- -->
        <div>
          <ul class="text-left">
            <li class="p-2">Por Colaboración</li>
            <li class="p-2">Por subir Tarea</li>
            <li class="p-2">Por Calificar</li>
            <li class="p-2">Por Cancelación</li>
            <li class="p-2">Por Reclamo Ventajoso</li>
          </ul>
        </div>

        <!-- ---------TEXTO 2 END---------------------------- -->

        <!-- ---------VALUE 2 START---------------------------- -->
        <div class="col-start-2">
          <ul class="text-center">
            <li class="my-1"><input type="number" class="input !h-[2rem] w-28" />%/$</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />PT</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />PT</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />PT</li>
            <li class="my-2"><input type="number" class="input !h-[2rem] w-28" />PT</li>
          </ul>
        </div>
        <!-- ---------VALUE 2 END---------------------------- -->
      </div>
      <!-- --------PANEL 2 PUNTOS END------------------- -->

      <!-- --------PANEL 4 CUPONES START------------------- -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 grid grid-cols-3 col-span-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center col-span-full">Cupones</h3>
        <hr class="col-span-full" />

        <!-- -----------TEXTO 4 START--------------- -->
        <div>
          <ul class="text-left">
            <li class="p-2">Por Calificaciones</li>
            <li class="p-2">Por Puntos</li>
            <li class="p-2">Por Tareas Subidas</li>
            <li class="p-2">Por Colaboraciones</li>
          </ul>
        </div>

        <!-- ---------TEXTO 4 END---------------------------- -->

        <!-- ---------VALUE 4 START---------------------------- -->
        <div class="col-start-2">
          <ul class="text-center">
            <li class="my-1">
              <input type="number" class="input !h-[2rem] w-28" /> Calific. minimas
            </li>
          </ul>
        </div>
        <!-- ---------VALUE 4 END---------------------------- -->

        <!-- ---------VALUE 4 END---------------------------- -->
        <div class="col-start-3">
          <ul class="text-center">
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
            <li class="my-2"><input type="checkbox" /> <span>ON/OFF</span></li>
          </ul>
        </div>

        <!-- ---------VALUE 4 END---------------------------- -->
      </div>
      <!-- --------PANEL 4 CUPONES END------------------- -->
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
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
    Tabs,
    Link
  },
};
</script>
