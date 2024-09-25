<template>
  <form @submit.prevent="form.post(route('collaborations.store'))">
    <div
      class="flex flex-col w-full mx-auto divide-y px-4 rounded-md divide-gray-400 bg-white text-gray-600 dark:divide-indigo-600 dark:bg-slate-900 dark:text-gray-300"
    >
      <div class="flex justify-between">
        <Avatar :user="homework_owner" />
        <Avatar :user="$page.props.auth.user" />
      </div>
      <div class="p-2">
        <p class="text-blue-600 dark:text-blue-400 text-sm">
          <i class="fa-solid fa-circle-info mr-1"></i>
          La plataforma te retendrá el {{ homework_owner.level.tax }}% de comisión por el
          uso de la misma
        </p>
        <div class="mt-2">
          <InputLabel class="dark:text-gray-300" value="Costo ($MXN)" />
          <Input v-model="form.price" type="number" class="input w-full" />
        </div>
        <div class="mt-2">
          <InputLabel class="dark:text-gray-300" value="Fecha promesa de entrega" />
          <Input v-model="form.promise_date" type="date" class="input w-full" />
        </div>
        <!-- <textarea
          v-model="form.comment"
          class="input !h-24 w-full mt-3"
          placeholder="Escribe un comentario (opcional)"
        ></textarea> -->
      </div>
      <div class="text-right">
        <button class="btn-primary mr-2 mt-3" v-if="!form.processing">Aplicar</button>
        <button class="btn-primary mr-2 mt-3" disabled v-else>
          Cargando...
          <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
        </button>
        <button type="button" class="btn-secondary" @click="$emit('cancel')">
          Cancelar
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";
import Input from "@/Components/Input.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      price: null,
      promise_date: null,
      homework_id: this.homework_id,
      comment: null,
    });

    return { form };
  },
  emits: ["cancel"],
  components: {
    Avatar,
    Input,
    InputLabel,
  },
  props: {
    homework_id: Number,
    homework_owner: Object,
  },
};
</script>
