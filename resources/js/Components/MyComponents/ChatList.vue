<template>
  <div
    class="border rounded-md border-dotted max-h-[35vh] min-h-[10vh] overflow-y-auto px-1 py-2 divide-y"
  >
    <template v-for="(item, index) in chats" :key="item.id">
      <div
        v-if="item.messages.length"
        @click="openMessages(item, index)"
        class="grid grid-cols-2 gap-x-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer rounded"
        :class="{
          'border-l-4 border-l-indigo-500 bg-indigo-50 hover:bg-indigo-100 dark:bg-slate-800 font-bold': isAnyUnread(
            item.messages
          ),
        }"
      >
        <Avatar
          class="inline-block"
          :user="getLast(excludeMyMessages(item.messages)).user"
          :secondary_info="getLast(excludeMyMessages(item.messages)).created_at.relative"
        />
        <p class="text-xs dark:text-gray-400 text-gray-600 truncate pt-2">
          {{ getLast(excludeMyMessages(item.messages)).content }}
        </p>
      </div>
    </template>
    <p v-if="!somethingToShow" class="text-center text-gray-400 text-xs pt-3">
      No tienes ningún comentario o pregunta
    </p>
  </div>
</template>

<script>
import Avatar from "@/Components/MyComponents/Avatar.vue";

export default {
  props: {
    chats: Array,
  },
  emits: ["showChat"],
  components: {
    Avatar,
  },
  computed: {
    somethingToShow() {
      return this.chats?.some((chat) => chat.messages.length);
    },
  },
  methods: {
    excludeMyMessages(messages) {
      return messages.filter((message) => message.user.id !== this.$page.props.user.id);
    },
    getLast(array) {
      if (array.length) return array.slice(-1)[0];
      return null;
    },
    isAnyUnread(messages) {
      if (messages.length) {
        return this.excludeMyMessages(messages).some(
          (message) => !message.read_at.special
        );
      }
    },
    openMessages(item, index) {
      if (this.isAnyUnread(item.messages)) {
        axios
          .post(route("chat.read-message"), { chat_id: item.id })
          .then((response) => {
            this.chats[index] = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
      this.$emit("showChat", item);
    },
  },
};
</script>
