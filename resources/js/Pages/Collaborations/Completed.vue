<template>
  <AppLayout title="Mis colaboraciones">
    <div class="bg-white dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <header class="flex bg-white dark:bg-slate-900 w-full">
        <Tabs :tabs="tabs" />
      </header>
      <div class="mt-12">
        <CollaborationTable
          :collaborations="collaborations"
          :filters="filters"
          filterURL="/collaborations/completed"
          @details="showDetails"
        />
      </div>
    </div>
  </AppLayout>
  <DetailsModal :show="side_modal" @close="side_modal = false">
    <template #title>
      <div class="flex flex-col">
        <h1 class="text-indigo-600 text-xl font-semibold">
          {{ collaboration_detail.homework.title }}
        </h1>
        <div class="flex justify-between">
          <small class="text-indigo-400 text-xs">
            <i class="fa-solid fa-tag"></i>
            {{ collaboration_detail.homework.school_subject.name }}
          </small>
          <div class="flex flex-col space-y-1">
            <small
              class="text-xs px-2 rounded-md"
              :class="
                collaboration_detail.homework.priority === 'Urgente'
                  ? 'text-red-700 bg-red-100 dark:text-red-900 dark:bg-red-500'
                  : 'text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500'
              "
              :title="'Prioridad: ' + collaboration_detail.homework.priority"
            >
              Límite: {{ collaboration_detail.homework.limit_date }}
            </small>
            <small
              class="text-xs px-2 rounded-md text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500"
            >
              Entregado: {{ collaboration_detail.completed_date }}
            </small>
          </div>
        </div>
      </div>
    </template>
    <template #content>
      <section class="mt-3">
        <div>
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-circle-info mr-2"></i>
            <span>Descripción</span>
          </h1>
          <div>
            <p class="text-sm text-gray-500">
              {{ collaboration_detail.homework.description }}
            </p>
            <div class="mt-3" v-if="collaboration_detail.payed_at.string">
              <span
                class="text-green-600 text-sm px-2 rounded-md bg-green-100 dark:text-green-900 dark:bg-green-500"
              >
                Pago realizado
              </span>
              <p class="text-green-600 text-xs">
                Te hemos enviado un correo con el comprobante del depósito. Muchas gracias
                por tus colaboraciones
                <i class="fa-regular fa-face-smile-beam m-1"></i>
              </p>
            </div>
            <div class="mt-3" v-else-if="collaboration_detail.bank_number">
              <span
                class="text-yellow-600 text-sm px-2 rounded-md bg-yellow-100 dark:text-yellow-900 dark:bg-yellow-500"
              >
                Pago en proceso
              </span>
              <p class="text-yellow-600 text-xs">
                Tu depósito se verá reflejado a más tardar 24 hrs después de ingresar tus
                datos. <br />
                Número de tarjeta: <strong>{{ collaboration_detail.bank_number }}</strong
                ><br />
                Banco: <strong>{{ collaboration_detail.bank_name }}</strong>
              </p>
            </div>
            <div class="mt-3" v-else-if="collaboration_detail.payment_released_at.string">
              <span
                class="text-green-600 text-sm px-2 rounded-md bg-green-100 dark:text-green-900 dark:bg-green-500"
              >
                Pago liberado
              </span>
              <p class="text-green-600 text-xs">
                (ve al botón "Acciones/Ingresar datos para depósito")
              </p>
            </div>
            <div class="mt-3" v-else>
              <span
                class="text-blue-600 text-sm px-2 rounded-md bg-blue-100 dark:text-blue-900 dark:bg-blue-500"
              >
                Esperando liberación de pago
              </span>
              <p class="text-blue-600 text-xs">
                El propietario está revisando los resultados de tu colaboración para poder
                liberar el pago. Si no lo libera en 48 hrs. Se liberará automáticamente
              </p>
            </div>
          </div>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-paperclip mr-2"></i>
            <span>Archivos adjuntos</span>
          </h1>
          <div
            v-if="collaboration_detail.homework.media.length"
            class="mt-1 flex flex-col"
          >
            <AttachedFile
              v-for="file in collaboration_detail.homework.media"
              :key="file.id"
              :name="file.name"
              :extension="file.mime_type.split('/')[1]"
              :href="file.original_url"
            />
          </div>
          <p v-else class="text-center text-gray-400 text-xs pt-3">
            No hay recursos para esta tarea
          </p>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-paperclip mr-2"></i>
            <span>Resultados de la tarea</span>
          </h1>
          <div class="mt-1 flex flex-col">
            <AttachedFile
              v-for="file in collaboration_detail.media"
              :key="file.id"
              :name="file.name"
              :extension="file.mime_type.split('/')[1]"
              :href="file.original_url"
            />
          </div>
        </div>
        <div class="mt-6">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <i class="fa-solid fa-star mr-2"></i>
            <span>Calificación de colaboración</span>
          </h1>
          <div v-if="collaboration_detail.rate" class="mt-1 flex flex-col">
            <div>
              <template v-for="n in 5" :key="n">
                <i
                  class="fa-solid fa-star"
                  :class="
                    n <= collaboration_detail.rate.stars
                      ? 'text-yellow-500'
                      : 'text-gray-400'
                  "
                ></i>
              </template>
            </div>
            <p class="mt-px text-sm dark:text-gray-500">
              {{ collaboration_detail.rate.comments }}
            </p>
          </div>
          <p v-else class="text-center text-gray-400 text-xs pt-3">
            No hay calificación para mostrar
          </p>
        </div>
      </section>
    </template>
    <template #footer>
      <div class="flex">
        <!-- <DropupButton>
          <template #links>
            <span @click="prepairChat" class="dropup-link">Mensajes</span>
            <span
              @click="showPaymentForm"
              v-if="
                collaboration_detail.payment_released_at.string &&
                !collaboration_detail.bank_number
              "
              class="dropup-link"
              >Ingresar datos para depósito</span
            >
          </template>
        </DropupButton> -->
        <button @click="side_modal = false" class="btn-secondary mx-2">Cerrar</button>
      </div>
    </template>
  </DetailsModal>
  <!-- Modal -->
  <DialogModal :show="dialog_modal" @close="hideModal">
    <template #title>
      <div v-if="show_chat" class="font-bold text-gray-600">
        Mensajes <br />
        <span class="text-indigo-500 font-normal">
          {{ collaboration_detail.homework.title }}
        </span>
      </div>
      <div v-if="show_payment_form" class="font-bold text-gray-600">
        Introducir datos para depósito <br />
        <span class="text-indigo-500 font-normal">
          {{ collaboration_detail.homework.title }}
        </span>
      </div>
    </template>
    <template #content>
      <MessagesModal :chat="chat" v-if="show_chat" />
      <!-- <PymentFormModal
        :collaboration="collaboration_detail"
        v-if="show_payment_form"
        @cancel="hideModal"
      /> -->
    </template>
    <template #footer></template>
  </DialogModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/MyComponents/Tabs.vue";
import CollaborationTable from "@/Components/MyComponents/CollaborationTable.vue";
import DetailsModal from "@/Components/MyComponents/DetailsModal.vue";
// import DropupButton from "@/Components/MyComponents/DropupButton.vue";
import MessagesModal from "@/Components/MyComponents/MessagesModal.vue";
import AttachedFile from "@/Components/MyComponents/AttachedFile.vue";
import DialogModal from "@/Components/DialogModal.vue";
// import PymentFormModal from "@/Components/MyComponents/PymentFormModal.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      collaboration_detail: {},
      chat: {},
      dialog_modal: false,
      show_chat: false,
      show_payment_form: false,
      show_send_homework: false,
      side_modal: false,
      show_confirmation: false,
      tabs: [
        {
          label: "Disponibles",
          url: "collaborations.index",
        },
        {
          label: "Esperando aprobación",
          url: "collaborations.approve-pendent",
        },
        {
          label: "En proceso",
          url: "collaborations.in-process",
        },
        {
          label: "Completados",
          url: "collaborations.completed",
        },
        {
          label: "Reclamos",
          url: "collaborations.claims",
        },
      ],
    };
  },
  components: {
    CollaborationTable,
    // PymentFormModal,
    // DropupButton,
    MessagesModal,
    DetailsModal,
    AttachedFile,
    DialogModal,
    AppLayout,
    Link,
    Tabs,
  },
  props: {
    collaborations: Object,
    filters: Object,
  },
  methods: {
    showDetails(item) {
      this.collaboration_detail = item;
      this.side_modal = true;
    },
    showChat() {
      this.show_chat = true;
      this.dialog_modal = true;
    },
    showPaymentForm() {
      this.show_payment_form = true;
      this.dialog_modal = true;
    },
    prepairChat() {
      const chat = this.searchChat();
      if (chat === undefined) {
        this.createChat();
      } else {
        if (this.isAnyUnread(chat.messages)) {
          this.markAsRead(chat);
        } else {
          this.chat = chat;
          this.showChat();
        }
      }
    },
    excludeMyMessages(messages) {
      return messages.filter((message) => message.user.id !== this.$page.props.user.id);
    },
    isAnyUnread(messages) {
      if (messages.length) {
        return this.excludeMyMessages(messages).some(
          (message) => !message.read_at.special
        );
      }
    },
    markAsRead(chat) {
      axios
        .post(route("chat.read-message"), {
          chat_id: chat.id,
        })
        .then((response) => {
          this.homework_detail.chats = [response.data];
          this.chat = response.data;
          this.showChat();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showSendHomework() {
      this.show_send_homework = true;
      this.dialog_modal = true;
    },
    searchChat() {
      const auth_user_id = this.$page.props.user.id;
      if (this.collaboration_detail.homework.chats.length) {
        return this.collaboration_detail.homework.chats.find((chat) =>
          chat.users.some((user) => user.id === auth_user_id)
        );
      }
      return undefined;
    },
    async createChat() {
      try {
        const response = await axios.post(route("chat.store"), {
          chat_mate_id: this.collaboration_detail.homework.user.id,
          homework_id: this.collaboration_detail.homework.id,
        });
        this.chat = response.data;
        this.collaboration_detail.homework.chats = [response.data];
        this.showChat();
      } catch (error) {
        console.log(error);
      }
    },
    hideModal() {
      this.show_send_homework = false;
      this.show_chat = false;
      this.show_payment_form = false;
      this.dialog_modal = false;
    },
  },
};
</script>
