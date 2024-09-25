<template>
  <AppLayout title="Administrador">
    <div class="dark:bg-slate-900 bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>

    <!-- --------BODY START------------ -->
    <div class="grid grid-cols-2 grid-rows-2 gap-4 py-4 px-4">
      <!-- --------PANEL 1 nueva difusion START------------ -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center">Nueva Notificación</h3>
        <hr />

        <input type="text" class="input my-4 w-1/2" placeholder="Asunto" />

        <div>
          <textarea class="input !h-28 mb-2" placeholder="Escribe tu Mensaje" cols="50">
          </textarea>
        </div>

        <button class="btn-primary">Enviar</button>
      </div>
      <!-- --------PANEL 1 nueva difusion END------------ -->

      <!-- --------PANEL 2 filtro START------------ -->
      <div
        class="bg-white dark:bg-slate-800 dark:text-gray-300 rounded-lg shadow-md px-3 py-2 col-start-2 row-span-2"
      >
        <h3 class="text-indigo-500 text-center">Filtro de difusión</h3>
        <hr />

        <div>
          <!-- <InputSearch
            :filters="filters"
            :filterURL="filterURL"
            class="my-4 mx-auto flex-1 w-2/3"
          /> -->
        </div>

        <div class="border-4 m-4 w-[80%] mx-auto h-1/2 overflow-y-auto">
          Aqui van los usuarios seleccionados para la notificacion
          <p></p>
        </div>

        <div class="ml-auto grid grid-col-2">
          <h3 class="text-left font-semibold mb-2">Opciones de difusión</h3>

          <ul class="col-start-1 text-right">
            <li>
              <label>Todos los Usuarios </label> <input type="radio" name="filter1" />
            </li>
            <li>
              <label>Todos Excepto a... </label> <input type="radio" name="filter1" />
            </li>
            <li><label>Solo a... </label> <input type="radio" name="filter1" /></li>
          </ul>

          <ul class="col-start-2 text-right">
            <li><label>Por escuela </label> <input type="radio" name="filter2" /></li>
            <li><label>Por Estado </label> <input type="radio" name="filter2" /></li>
            <li><label>Por Usuario </label> <input type="radio" name="filter2" /></li>
          </ul>
        </div>

        <button class="btn-primary mt-4">Aplicar</button>
      </div>
      <!-- --------PANEL 2 filtro END------------ -->

      <!-- --------PANEL 3 BANNER START------------ -->
      <div
        class="dark:bg-slate-800 dark:text-gray-300 bg-white rounded-lg shadow-md px-3 py-2 max-h-72"
      >
        <h3 class="text-indigo-500 text-center">Banner</h3>
        <hr />

        <div class="grid grid-cols-2 m-4">
          <div>
            <h3 class="text-left font-semibold mb-2">Seleccionar Banner</h3>
            <input type="file" class="border-2 border-dashed p-10 mt-4" />
          </div>

          <div class="ml-auto">
            <h3 class="text-left font-semibold mb-2">Mostrar en...</h3>

            <ul class="text-right">
              <li><label>Dashboard </label> <input type="radio" /></li>
              <li><label>Tareas </label> <input type="radio" /></li>
              <li><label>Colaboraciones </label> <input type="radio" /></li>
            </ul>
          </div>
        </div>

        <button class="btn-primary">Enviar</button>
      </div>
      <!-- --------PANEL 3 BANNER END------------ -->
    </div>
    <!-- --------BODY END------------ -->
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
// import InputSearch from "@/Components/MyComponents/InputSearch.vue";
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
    // InputSearch,
    AppLayout,
    Tabs,
    Link
  },
  methods: {},
  props: {
    filters: Object,
    filterURL: String,
  },
};
</script>
