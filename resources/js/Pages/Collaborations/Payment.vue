<template>
  <AppLayout title="Pago de colaboración">
    <div class="lg:grid grid-cols-2 gap-4">
      <div class="section-container mx-6 my-4">
        <div
          class="
            container
            flex flex-col
            w-full
            px-4
            mx-auto
            divide-y
            rounded-md
            divide-gray-400
          "
        >
          <div class="flex justify-between">
            <Avatar :user="collaboration.user" secondary_info="Colaborador" />
          </div>
          <div class="p-4 space-y-2 text-sm">
              <div class="grid grid-cols-2">
                <p class="my-1">Nombre de tarea</p>
                <p class="my-1 font-bold">{{ collaboration.homework.title }}</p>
              </div>
              <div class="grid grid-cols-2">
                <p class="my-1">Entrega pactada</p>
                <p class="my-1 font-bold">{{ collaboration.promise_date }}</p>
              </div>
              <div class="grid grid-cols-2">
                <p class="my-1">Costo</p>
                <p class="my-1 text-green-600">${{ collaboration.price }}</p>
              </div>
          </div>
        </div>
      </div>
      <div class="section-container mx-6 my-4">
        <div class="flex justify-between items-center">
          <h1 class="mb-3 font-bold">Método de Pago</h1>
          <img src="@/resources/images/we-accept.png" class="h-8" />
        </div>
        <form id="card-form">
          <div>
            <Label value="Nombre de titular" />
            <input
              id="card-holder-name"
              class="input w-full mb-3"
              type="text"
              placeholder="Ingrese el nombre del titular de la tarjeta"
              required
            />
          </div>

          <!-- Stripe Elements Placeholder -->
          <Label value="Tarjeta" />
          <div class="w-full mb-3 border rounded-md p-3 dark:bg-indigo-400">
            <div id="card-element"></div>

            <span class="text-red-500 italic text-sm" id="card-error"></span>
          </div>

          <button id="card-button" class="btn-primary">Procesar pago</button>
        </form>
      </div>
    </div>
  </AppLayout>
</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";
import Label from "@/Jetstream/Label.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
export default {
  data() {
    const form = useForm({
      approved: true,
    });
    return { form };
  },
  components: {
    Avatar,
    RatingStars,
    AppLayout,
    Link,
    Label,
  },
  props: {
    publicKey: String,
    collaboration: Object,
  },
  methods: {
    processPayment() {
      this.form.put(route("collaborations.approve", this.collaboration.id));
    },
  },
  mounted() {
    const stripe = Stripe(this.publicKey);
    const elements = stripe.elements();
    const cardElement = elements.create("card");
    cardElement.mount("#card-element");
    // payment method
    const cardHolderName = document.getElementById("card-holder-name");
    const cardButton = document.getElementById("card-button");
    const cardForm = document.getElementById("card-form");
    cardForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      cardButton.disabled = true;
      cardButton.innerHTML = 'Procesando...';

      const { paymentMethod, error } = await stripe.createPaymentMethod(
        "card",
        cardElement,
        {
          billing_details: { name: cardHolderName.value },
        }
      );
      if (error) {
        document.getElementById("card-error").textContent = error.message;
      } else {
        Inertia.post(route("collaborations.payment-method.create"), {
          price: this.collaboration.price,
          payment_method: paymentMethod.id,
          collaboration_id: this.collaboration.id,
        });
      }
    });
  },
};
</script>