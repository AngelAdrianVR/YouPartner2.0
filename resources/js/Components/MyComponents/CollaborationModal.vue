<template>
  <div
    class="flex flex-col w-4/5 mx-auto rounded-lg divide-gray-400 bg-gray-600 text-gray-100 dark:divide-indigo-600 dark:bg-gray-800 dark:text-gray-100"
  >
    <div class="flex justify-around p-2 border-b">
      <div class="flex space-x-4">
        <figure>
          <img
            :src="collaboration.user.profile_photo_url"
            class="object-cover w-12 h-12 rounded-full"
          />
        </figure>
        <div>
          <h4 class="font-bold">{{ collaboration.user.name }}</h4>
          <span class="text-xs">{{ collaboration.created_at.relative }}</span>
        </div>
      </div>
      <div class="flex items-center space-x-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
          class="w-6 h-6 fill-current text-yellow-500"
        >
          <path
            d="M494,198.671a40.536,40.536,0,0,0-32.174-27.592L345.917,152.242,292.185,47.828a40.7,40.7,0,0,0-72.37,0L166.083,152.242,50.176,171.079a40.7,40.7,0,0,0-22.364,68.827l82.7,83.368-17.9,116.055a40.672,40.672,0,0,0,58.548,42.538L256,428.977l104.843,52.89a40.69,40.69,0,0,0,58.548-42.538l-17.9-116.055,82.7-83.368A40.538,40.538,0,0,0,494,198.671Zm-32.53,18.7L367.4,312.2l20.364,132.01a8.671,8.671,0,0,1-12.509,9.088L256,393.136,136.744,453.3a8.671,8.671,0,0,1-12.509-9.088L144.6,312.2,50.531,217.37a8.7,8.7,0,0,1,4.778-14.706L187.15,181.238,248.269,62.471a8.694,8.694,0,0,1,15.462,0L324.85,181.238l131.841,21.426A8.7,8.7,0,0,1,461.469,217.37Z"
          ></path>
        </svg>
        <span class="text-xl font-bold text-yellow-500"
          >{{ collaboration.user.rate_average }}/5.0</span
        >
      </div>
    </div>
    <div class="p-4 space-y-2 text-sm">
      <div class="grid grid-cols-2">
        <div class="col-start-1 mx-5">
          <p class="my-1">Colaboraciones</p>
          <p class="my-1">Reclamos</p>
          <p class="my-1">Grado Académico</p>
          <p class="my-1">Colaboraciones canceladas</p>
          <p class="my-1">Se unió el</p>
        </div>
        <div class="col-start-2 mx-5">
          <p class="my-1">{{ collaboration.user.collaborations.length }}</p>
          <p class="my-1">{{ collaboration.user.claims_to_user.length }}</p>
          <p class="my-1">{{ collaboration.user.academic_grade }}</p>
          <p class="my-1">
            {{ collaboration.user.canceled_collaborations.length }}
          </p>
          <p class="my-1">{{ collaboration.user.created_at.special }}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="w-4/5 grid grid-cols-2 text-sm mx-auto font-semibold mt-2">
    <div class="col-start-1 dark:text-gray-300">
      <p class="my-1">Entrega Pactada</p>
      <p class="my-1">costo</p>
    </div>
    <div class="col-start-2">
      <span class="my-1 dark:text-gray-200 font-bold">{{
        collaboration.promise_date
      }}</span>
      <p class="my-1 text-green-600">${{ collaboration.price }}</p>
    </div>
  </div>
  <div class="text-right">
    <Link :href="route('payment', collaboration)" class="btn-primary mx-2 my-4"
      >Aceptar Colaboración</Link
    >
    <!-- <button class="btn-primary mx-2 my-4" @click="$emit('accepted')">Aceptar Colaboración</button> -->
    <!-- <button class="btn-secondary mx-2">Comentar</button> -->
  </div>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    Link,
  },
  props: {
    collaboration: Object,
  },
};
</script>
