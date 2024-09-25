<template>
  <!-- sidebar -->
  <div
    class="h-screen hidden lg:block shadow-gray-500/70 dark:shadow-indigo-500/100 shadow-xl relative"
  >
    <div class="bg-white h-full transition-dark dark:bg-slate-900">
      <div class="flex items-center justify-center pt-12 pb-2">
        <ApplicationMark class="block h-14 w-auto" />
      </div>
      <nav class="mt-12">
        <div>
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <span class="text-left">
              <i class="fas fa-tachometer-alt"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Panel de información </span>
          </NavLink>
          <NavLink
            :href="route('homeworks.no-collaboration')"
            :active="route().current('homeworks.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-file-pen"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Mis tareas </span>
          </NavLink>
          <NavLink
            :href="route('collaborations.index')"
            :active="route().current('collaborations.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-handshake-angle"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Colaborar </span>
          </NavLink>
          <NavLink
            :href="route('ranking.index')"
            :active="route().current('ranking.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-ranking-star"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Ranking </span>
          </NavLink>
          <NavLink
            :href="route('library.index')"
            :active="route().current('library.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-book"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Biblioteca </span>
          </NavLink>
          <NavLink
            :href="route('error-reports.index')"
            :active="route().current('error-reports.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-headset"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Errores y sugerencias </span>
          </NavLink>
          <NavLink
            v-if="$page.props.auth.user.is_admin"
            :href="route('admin.finances')"
            :active="route().current('admin.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-user-secret"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Administrador </span>
          </NavLink>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

export default {
  components: {
    NavLink,
    ApplicationMark,
  },
};
</script>
