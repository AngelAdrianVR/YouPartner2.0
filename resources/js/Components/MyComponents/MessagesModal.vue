<template>
  <div class="">
    <div>
      <div class="flex justify-between">
        <Avatar :user="getTheOtherUser" />
        <Avatar :user="$page.props.user" />
      </div>
      <div class="border border-gray-300 overflow-y-auto h-64 rounded-md mx-auto">
        <div
          v-for="message in chat.messages"
          :key="message.id"
          class="flex"
          :class="{ 'justify-end': message.user.id === $page.props.user.id }"
        >
          <div
            class="max-w-[14rem] lg:max-w-md rounded-lg my-1 mx-3 p-2 pb-0"
            :class="
              message.user.id === $page.props.user.id
                ? 'dark:bg-indigo-500 bg-indigo-200 text-right'
                : 'bg-gray-200 dark:bg-gray-500'
            "
          >
            <p class="text-[13px]" style="white-space: pre-line">
              {{ message.content }}
            </p>
            <span class="text-[11px] dark:text-gray-900 text-gray-500">{{
              message.created_at.relative
            }}</span>
          </div>
        </div>
        <span ref="bottom" class="mt-20"></span>
      </div>
      <form @submit.prevent="sendMessage" class="text-center flex items-center mt-2">
        <textarea
          v-model.lazy="form.content"
          class="input flex-1 mr-3 !h-16"
          placeholder="Escribe tu mensaje aquí..."
        >
        </textarea>
        <button type="submit" class="btn-primary">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
    </div>
    <br />
  </div>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      content: null,
      chat_id: this.chat.id,
      user_id: this.$page.props.user.id,
    });

    return { form };
  },
  components: {
    Avatar,
  },
  props: {
    chat: Object,
  },
  computed: {
    getTheOtherUser() {
      const auth_user_id = this.$page.props.user.id;
      return this.chat.users.filter((user) => user.id != auth_user_id)[0];
    },
  },
  methods: {
    sendMessage() {
      if (this.form.content) {
        axios
          .post(route("chat.send-message"), this.form)
          .then((response) => {
            this.chat.messages.push(response.data);
            this.form.content = "";
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    scrollToBottom() {
      this.$refs.bottom.scrollIntoView({ behavior: "smooth" });
    },
  },
  updated() {
    this.scrollToBottom();
  },
};
</script>
