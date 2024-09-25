<template>
  <AppLayout title="Ranking">
    <div class="bg-gray-200 transition-dark dark:bg-slate-900">
      <div class="container mx-auto mb-5 p-5">
        <div class="md:flex no-wrap md:-mx-2">
          <!-- Left Side -->
          <div class="w-full md:w-3/12 md:mx-2">
            <!-- Profile Card -->
            <div
              :class="user.active ? 'border-green-500 ' : 'border-red-500 '"
              class="bg-white transition-dark dark:bg-slate-800 p-3 border-t-4 shadow-md"
            >
              <div class="image overflow-hidden h-64">
                <img
                  class="h-auto w-3/5 mx-auto rounded-lg"
                  :src="user.profile_photo_url"
                />
              </div>
              <h1
                class="text-gray-900 dark:text-gray-300 font-bold text-xl leading-8 my-1"
              >
                {{ user.name }}
              </h1>
              <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
                {{ user.description }}
              </p>
              <ul
                class="bg-gray-100 transition-dark dark:bg-slate-800 dark:text-gray-400 text-gray-600 hover:text-gray-900 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
              >
                <li class="flex items-center py-3">
                  <span>Estatus</span>
                  <span class="ml-auto"
                    ><span
                      :class="user.active ? 'bg-green-600' : 'bg-red-500'"
                      class="py-1 px-2 rounded text-white text-sm"
                      >{{ user.active ? "Activo" : "Inactivo" }}</span
                    ></span
                  >
                </li>
                <li class="flex items-center py-3">
                  <span>Miembro desde</span>
                  <span class="ml-auto">{{ user.created_at.special }}</span>
                </li>
                <li class="flex items-center py-3">
                  <LevelBar />
                </li>
              </ul>
            </div>
            <!-- End of profile card -->
            <div class="my-4"></div>
          </div>
          <!-- Right Side -->
          <div class="w-full md:w-9/12 mx-2 h-64">
            <!-- Profile tab -->
            <!-- About Section -->
            <div
              :class="user.active ? 'border-green-500 ' : 'border-red-500 '"
              class="bg-white transition-dark dark:bg-slate-800 p-3 shadow-md rounded-sm border-t-4"
            >
              <div
                class="flex items-center space-x-2 font-semibold text-gray-800 leading-8"
              >
                <span clas="text-green-500">
                  <svg
                    class="h-5 dark:text-gray-300"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg>
                </span>
                <span class="tracking-wide border-b-2 dark:text-gray-300"
                  >Información Personal</span
                >
              </div>
              <div class="dark:text-gray-400 text-gray-600">
                <div class="grid md:grid-cols-2 text-sm">
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Escuela:</div>
                    <div class="px-4 py-2">{{ user.school_name }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Colaboraciones:</div>
                    <div class="px-4 py-2">{{ user.collaborations.length }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Fecha de Nacimiento:</div>
                    <div class="px-4 py-2">{{ user.birthdate }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Tareas subidas:</div>
                    <div class="px-4 py-2">{{ user.homeworks.length }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Grado académico:</div>
                    <div class="px-4 py-2">
                      {{ user.academic_grade }}
                    </div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-bold text-white">Reclamos:</div>
                    <div class="px-4 py-2">{{ user.claims_to_user?.length ?? '' }}</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of about section -->

            <div class="my-4"></div>

            <!-- Raiting -->
            <div
              class="bg-white transition-dark dark:bg-slate-800 p-3 shadow-md rounded-sm text-center"
            >
              <div
                class="flex items-center space-x-2 font-semibold text-gray-900 leading-8"
              >
                <i
                  class="fa-solid fa-square-poll-horizontal text-lg text-gray-700 dark:text-gray-300 pl-6"
                ></i>
                <span class="tracking-wide border-b-2 dark:text-gray-400"
                  >Calificación de Usuario</span
                >
              </div>
              <div class="grid lg:grid-cols-2 mt-2">
                <div class="mr-2 my-2">
                  <ReviewUser />
                </div>

                <div class="max-h-96 overflow-y-auto">
                  <Comment />
                  <Comment />
                  <Comment />
                </div>
              </div>
              <!-- End of Experience and education grid -->
            </div>
            <!-- End of profile tab -->
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
  <!-- component -->
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import LevelBar from "@/Components/MyComponents/LevelBar.vue";
import ReviewUser from "@/Components/MyComponents/ReviewUser.vue";
import Comment from "@/Components/MyComponents/Comment.vue";

export default {
  data() {
    return {};
  },
  props: {
    user: Object,
  },
  components: {
    LevelBar,
    ReviewUser,
    Comment,
    AppLayout,
  },
};
</script>
