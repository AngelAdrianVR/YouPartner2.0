<template>
  <div class="lg:flex justify-between items-center py-1 mt-2 space-x-1">
    <!-- <InputSearch
      :filters="filters"
      :filterURL="filterURL"
      class="mb-2 flex-1"
    /> -->
    <!-- <Pagination :pagination="homeworks" /> -->
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="homeworks.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="homework in homeworks.data"
          :key="homework.id"
          class="focus:outline-none h-16 border dark:text-gray-300 dark:border-slate-800 border-gray-100 rounded"
        >
          <td class="px-3">
            <StatusIcon :status="homework.status" />
          </td>
          <td class="pr-9">
            <Avatar :user="homework.user"/>
          </td>
          <td>
            <div class="flex items-center pl-1">
              <p class="font-medium leading-none dark:text-gray-300 text-gray-700 mr-2 truncate">
                {{ homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div class="flex items-center dark:text-gray-300 text-gray-600" title="Materia">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none ml-2">
                {{ homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center dark:text-gray-300 text-gray-600" title="Archivos adjuntos">
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none ml-2">{{ homework.media.length }}</p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded"
              :class="homework.priority === 'Urgente' ? 'dark:text-red-500 text-red-700' : 'dark:text-green-500 text-green-700'"
              :title="'Prioridad: ' + homework.priority"
            >
            <i class="mr-2 text-lg fa-solid fa-calendar-days"></i>
              Límite: {{ homework.limit_date }}
            </div>
          </td>
          <td>
            <button
              @click="showDetails(homework)"
              class="dark:text-gray-200 dark:bg-blue-900 dark:hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 text-sm leading-none text-gray-600 mr-4 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
              Ver
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="text-center text-gray-500 my-3">
      No hay ningún registro para mostrar
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/MyComponents/Pagination.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
// // import InputSearch from "@/Components/MyComponents/InputSearch.vue";
import { Link } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import StatusIcon from "@/Components/MyComponents/StatusIcon.vue";

export default {
  data() {
    return {

    };
  },
  emits: ['details'],
  components: {
    Pagination,
    Avatar,
    // InputSearch,
    Link,
    DangerButton,
    SecondaryButton,
    StatusIcon,
  },
  props: {
    homeworks: Object,
    filters: Object,
    filterURL: String,
  },
  methods: {
    showDetails(prop) {
      this.$emit("details", prop);
    },
  },
};
</script>