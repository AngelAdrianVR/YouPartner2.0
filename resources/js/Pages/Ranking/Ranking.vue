<template>
  <AppLayout title="Ranking">
    <div class="bg-white dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <header class="flex fixed bg-white dark:bg-slate-900 w-full top-[49px] z-30">
        <Tabs :tabs="tabs" class="my-5" />
      </header>
    </div>

    <!-- ------------INICIO DEL BODY---------------------- -->
    <div>
      <h2 class="text-indigo-500 text-center mt-8 text-lg font-semibold">
        Ranking por de Colaboraciones
      </h2>

      <div class="grid lg:grid-cols-2 sm:grid-cols-1">
        <!-- ------------INICIO DEL PANEL 1 TOP 10---------------------- -->

        <div
          class="my-6 mx-8 dark:bg-slate-800 bg-white rounded-lg shadow-md max-h-screen col-span-2 lg:col-span-1"
        >
          <h2 class="text-indigo-500 text-md font-bold text-center mt-2">TOP 10</h2>
          <hr class="mx-5" />

          <ul class="my-4">
            <li
              v-for="(place, index) in top_ten"
              :key="place.id"
              class="flex items-center"
            >
              <i
                :class="rankProps(index).icon + ' ' + rankProps(index).color"
                class="text-3xl mx-4 my-1"
              ></i>
              <div class="">
                <img
                  src="https://source.unsplash.com/100x100/?portrait"
                  alt=""
                  class="object-cover w-9 h-9 rounded-full dark:bg-gray-500"
                />
              </div>
              <span
                :class="rankProps(index).color"
                class="mr-1 bg-gray-300 dark:bg-slate-700 rounded-md w-[60%] font-bold p-1"
                >{{ place.name }}</span
              >
              <span
                class="inline-block bg-gray-600 dark:text-gray-300 rounded-md w-[15%] text-white font-bold p-1 text-center"
                >{{ place.points }}</span
              >
            </li>
          </ul>
        </div>

        <!-- ------------INICIO DEL PANEL 2---------------------- -->
        <div class="my-6 mx-4 rounded-lg max-h-screen lg:grid-cols-2 sm:grid-cols-1">
          <h2 class="text-indigo-500 text-md font-bold text-center mt-2">TOP 3</h2>
          <hr class="mx-5" />

          <div class="grid grid-cols-2 grid-rows-2">
            <div
              class="bg-gradient-to-r from-sky-500 to-indigo-500 rounded-lg my-3 ml-4 row-span-2 shadow-xl"
            >
              <h1 class="text-center my-2">TOP 1</h1>
              <div class="w-[60%] h-[45%] border-2 border-white mx-auto">
                foto de la persona
              </div>

              <div class="w-[80%] h-[35%] border-2 border-white mt-3 mx-auto text-center">
                <p>nombre</p>
                <p>estado</p>
                <p>escuela</p>
                <p>grado academico</p>
              </div>
            </div>

            <div
              class="h-48 w-72 bg-gradient-to-r from-gray-400 to-gray-700 rounded-lg my-3 ml-4 grid grid-cols-5 shadow-xl"
            >
              <h1 class="text-left mt-2">2</h1>
              <div
                class="w-[60%] h-[60%] border-2 border-white mx-3 col-start-1 col-span-2"
              >
                foto de la persona
              </div>

              <div
                class="w-[80%] h-[100%] border-2 border-white text-center col-start-3 col-span-3 mb-4"
              >
                <p>nombre</p>
                <p>estado</p>
                <p>escuela</p>
                <p>grado academico</p>
              </div>
            </div>

            <div
              class="h-48 w-72 bg-gradient-to-r from-amber-500 to-amber-700 rounded-lg my-3 ml-4 grid grid-cols-5 shadow-xl"
            >
              <h1 class="text-left mt-2">3</h1>
              <div
                class="w-[60%] h-[60%] border-2 border-white mx-3 col-start-1 col-span-2"
              >
                foto de la persona
              </div>

              <div
                class="w-[80%] h-[100%] border-2 border-white text-center col-start-3 col-span-3 mb-4"
              >
                <p>nombre</p>
                <p>estado</p>
                <p>escuela</p>
                <p>grado academico</p>
              </div>
            </div>
          </div>
        </div>
        <!-- ------------FINAL DEL PANEL 2---------------------- -->

        <!-- ------------FINAL DEL PANEL 1 TOP 10---------------------- -->
      </div>
    </div>
    <!-- ------------FUINAL DEL BODY---------------------- -->
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
          label: "Ranking",
          url: "ranking.index",
        },
        {
          label: "Premios",
          url: "ranking.awards",
        },
        {
          label: "Motivacion",
          url: "ranking.motivation",
        },
        {
          label: "Niveles",
          url: "ranking.levels",
        },
      ],
      top_ten: [
        {
          name: "Angel Vazquez",
          points: 200,
          rank: 1,
        },
        {
          name: "Miguel Vazquez",
          points: 189,
          rank: 2,
        },
        {
          name: "Jose Perez",
          points: 180,
          rank: 3,
        },
        {
          name: "Rebeca Gomez",
          points: 170,
          rank: 4,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 5,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 6,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 7,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 8,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 9,
        },
        {
          name: "Gerardo Sant",
          points: 164,
          rank: 10,
        },
      ],
      top_three: [
        {
          name: "Angel Vazquez",
          points: 200,
          rank: 1,
        },
        {
          name: "Miguel Vazquez",
          points: 189,
          rank: 2,
        },
        {
          name: "Jose Perez",
          points: 180,
          rank: 3,
        },
      ],
    };
  },
  components: {
    AppLayout,
    Tabs,
    Link
  },
  methods: {
    rankProps(index) {
      if (this.top_ten[index].rank == 1) {
        return { icon: "fa-solid fa-trophy", color: "text-amber-500" };
      }
      if (this.top_ten[index].rank == 2) {
        return { icon: "fa-solid fa-trophy", color: "text-gray-500" };
      }
      if (this.top_ten[index].rank == 3) {
        return { icon: "fa-solid fa-trophy", color: "text-amber-700" };
      }
      if (this.top_ten[index].rank > 3) {
        return { icon: "fa-solid fa-medal", color: "text-gray-500" };
      }
    },
  },
};
</script>
