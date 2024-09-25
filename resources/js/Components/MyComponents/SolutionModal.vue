<template>
  <div
    class="container flex flex-col w-full px-2 pb-0 mx-auto divide-y rounded-md divide-gray-400 dark:bg-gray-900 dark:text-gray-100"
  >
    <p>
      Costo de collaboración: <span class="font-bold text-indigo-600">${{ price }}</span>
    </p>
    <form @submit.prevent="send" class="p-4 space-y-2 text-sm dark:text-gray-400">
      <textarea
        v-model="form.solution_details"
        class="input !h-28 w-full"
        placeholder="Escribe los motivos de la decisión"
      ></textarea>
      <input
        v-model="form.solution"
        placeholder="Escribe la decisión final"
        type="text"
        class="input mt-3 w-full"
      />
      <input
        v-model="form.refund"
        placeholder="% de reembolso"
        type="number"
        class="input mt-3 w-full"
      />
      <div class="text-right">
        <button type="submit" v-if="!form.processing" class="btn-primary mr-2">
          Enviar
        </button>
        <button v-else class="btn-primary mr-2" disabled>
          Enviando...
          <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
        </button>
        <button @click="$emit('cancel')" class="btn-secondary">Cancelar</button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      solution_details: null,
      solution: null,
      refund: null,
      claim_id: this.claim.id,
    });

    return {
      form,
      //   processing: false,
    };
  },
  emits: ["cancel"],
  components: {
  },
  props: {
    claim: Object,
    price: Number,
  },
  methods: {
    send() {
      this.form.put(route("claims.update", this.claim.id), {
        onSuccess: () => {
          this.$emit("cancel");
        },
      });
    },
  },
};
</script>
