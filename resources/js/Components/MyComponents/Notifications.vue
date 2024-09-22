<template>
  <Dropdown align="right" width="72">
    <template #trigger>
      <span
        class="flex text-sm border-2 border-transparent rounded-full dark:focus:border-slate-600 cursor-pointer transition relative"
      >
        <i
          class="fa-solid fa-bell text-lg text-indigo-400 hover:text-indigo-500 mx-2"
        ></i>
      </span>
      <div v-if="unreadNotifications">
        <div
          class="w-2 h-2 rounded-full absolute top-1 right-1 bg-red-500 animate-ping"
        ></div>
        <div class="w-2 h-2 rounded-full absolute top-1 right-1 bg-red-400"></div>
      </div>
    </template>

    <template #content>
      <div v-if="notifications.length" class="max-h-80 overflow-y-auto divide-y">
        <DropdownLink
          as="button"
          @click="markAsRead(notification)"
          v-for="notification in notifications"
          :key="notification.id"
        >
          <div
            :class="
              !notification.read_at.relative
                ? 'font-bold text-gray-100 border-l-2 border-indigo-400 pl-2'
                : ''
            "
            class="text-gray-400 text-xs flex flex-col"
          >
            {{ notification.data.message }}
            <span class="text-gray-400 text-[10px] pt-2">{{
              notification.created_at.relative
            }}</span>
          </div>
        </DropdownLink>
      </div>
      <div v-else class="text-center text-gray-400 text-xs px-4 py-2">
        No tienes notificaciones
      </div>
    </template>
  </Dropdown>
</template>

<script>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
// import { Inertia } from "@inertiajs/inertia";

export default {
  data() {
    return {
      notifications: [],
    };
  },
  components: {
    Dropdown,
    DropdownLink,
  },
  methods: {
    async getNotifications() {
      try {
        const response = await axios.get(
          route("notifications.all", this.$page.props.auth.user.id)
        );
        this.notifications = response.data.notifications;
      } catch (error) {
        console.log(error);
      }
    },
    markAsRead(notification) {
      this.$inertia.post(route("notifications.mark-as-read", notification));
    },
  },
  computed: {
    unreadNotifications() {
      return this.notifications.some((notification) => !notification.read_at.string);
    },
  },
  mounted() {
    this.getNotifications();
  },
};
</script>
