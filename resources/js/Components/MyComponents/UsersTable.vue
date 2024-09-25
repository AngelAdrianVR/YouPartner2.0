<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="users" />
  </div>
  <div class="overflow-x-auto text-sm px-4">
    <table v-if="users.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="user in users.data"
          :key="user.id"
          class="focus:outline-none h-16 border border-gray-100 bg-white dark:border-slate-800 dark:bg-slate-900 transition-dark rounded"
        >
          <td class="pl-1 dark:bg-slate-600 bg-gray-300 text-center font-semibold">
            {{ "id: " + user.id }}
          </td>
          <td class="">
            <Avatar :user="user" />
          </td>
          <td>
            <div class="flex items-center">
              <i
                class="fa-regular fa-handshake mx-2 text-lg text-indigo-600"
                title="Colaboraciones"
              ></i>
              <p class="font-medium leading-none dark:text-gray-300 text-gray-700 mr-2">
                {{ user.collaborations.length }}
              </p>
            </div>
          </td>
          <td class="">
            <div class="flex items-center">
              <i class="fa-regular fa-star text-lg text-yellow-500" title="Ranking"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center">
              <i
                class="fa-solid fa-circle-exclamation text-red-500 text-xl"
                title="Reclamos"
              ></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">
                {{ user.claims_by_user.length }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center">
              <i class="fa-solid fa-angles-up text-lg text-green-600" title="Nivel"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">
                {{ 0 }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center">
              <i class="fa-solid fa-right-to-bracket text-lg" title="Se unió el..."></i>
              <span class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">
                {{ user.created_at.string }}
              </span>
            </div>
          </td>

          <td class="pl-2">
            <div class="py-3 text-sm focus:outline-none leading-none rounded">
              <i class="fa-solid fa-cake-candles text-lg text-sky-300"></i>
              <span class="dark:text-gray-300">{{ user.birthdate }}</span>
            </div>
          </td>
          <td class="pl-4">
            <button
              @click="showDetails(claim)"
              class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 text-sm leading-none text-gray-600 mr-4 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none dark:text-gray-200 dark:bg-blue-900 dark:hover:bg-blue-700"
            >
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
import Input from "@/Components/Input.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    ConfirmationModal,
    SecondaryButton,
    DangerButton,
    Pagination,
    Avatar,
    Input,
    Link,
  },
  props: {
    users: Object,
  },
  methods: {},
};
</script>
