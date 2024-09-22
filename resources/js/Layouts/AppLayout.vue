<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import SideNav from "@/Components/MyComponents/SideNav.vue";
import Notifications from "@/Components/MyComponents/Notifications.vue";
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="overflow-y-hidden h-screen bg-gray-200 lg:grid lg:grid-cols-6">
            <aside>
                <SideNav />
            </aside>
            <!-- Page Content -->
            <main class="col-span-5">
                <!-- nav -->
                <nav
                class="bg-white border-b dark:border-slate-800 border-gray-100 dark transition-dark dark:bg-slate-900"
                >
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between lg:block py-1">
                    <img
                        src="@/../../public/images/logo_claro.png"
                        class="w-1/3 lg:hidden"
                        alt="LOGO"
                    />
                    <div class="flex justify-end h-12">
                        <div class="hidden lg:flex sm:items-center sm:ml-6">
                        <!-- notifications -->
                        <Notifications />

                        <!-- dark mode palette -->

                        <Dropdown align="right" width="20">
                            <template #trigger>
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                            >
                                <i
                                class="fa-solid fa-palette text-lg text-indigo-400 hover:text-indigo-500 mx-2"
                                ></i>
                            </button>
                            </template>

                            <template #content>
                            <!-- Account Management -->
                            <div class="block text-center px-4 py-2 text-xs text-gray-400">
                                <i
                                x-on:click="darkMode = false"
                                class="fa-solid fa-sun text-indigo-400 hover:text-indigo-500 text-lg cursor-pointer"
                                ></i>
                                <i
                                x-on:click="darkMode = true"
                                class="fa-solid fa-moon text-indigo-400 hover:text-indigo-500 text-lg cursor-pointer"
                                ></i>
                            </div>
                            </template>
                        </Dropdown>

                        <!-- profile Dropdown -->
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                v-if="$page.props.jetstream.managesProfilePhotos"
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                >
                                <img
                                    class="h-8 w-8 rounded-full object-cover"
                                    :src="$page.props.auth.user.profile_photo_url"
                                    :alt="$page.props.auth.user?.name"
                                />
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                >
                                    {{ $page.props.auth.user?.name }}

                                    <svg
                                    class="ml-2 -mr-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                    </svg>
                                </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                                </div>

                                <DropdownLink :href="route('profile.show')">
                                Perfil
                                </DropdownLink>

                                <DropdownLink
                                v-if="$page.props.jetstream.hasApiFeatures"
                                :href="route('api-tokens.index')"
                                >
                                API Tokens
                                </DropdownLink>

                                <div class="border-t border-gray-100" />

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                <DropdownLink as="button"> Cerrar sesión </DropdownLink>
                                </form>
                            </template>
                            </Dropdown>
                        </div>
                        </div>

                        <Dropdown align="right" width="20" class="flex mt-2 lg:hidden">
                        <template #trigger>
                            <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                            >
                            <i
                                class="fa-solid fa-palette text-lg text-indigo-400 hover:text-indigo-500 mx-2"
                            ></i>
                            </button>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block text-center px-4 py-2 text-xs text-gray-400">
                            <i
                                x-on:click="darkMode = false"
                                class="fa-solid fa-sun text-indigo-400 hover:text-indigo-500 text-lg cursor-pointer"
                            ></i>
                            <i
                                x-on:click="darkMode = true"
                                class="fa-solid fa-moon text-indigo-400 hover:text-indigo-500 text-lg cursor-pointer"
                            ></i>
                            </div>
                        </template>
                        </Dropdown>

                        <!-- <Notifications class="flex mt-2 lg:hidden mr-1" /> -->

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center lg:hidden">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 dark:bg-slate-700 dark:text-gray-300 transition"
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                        >
                            <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                            >
                            <path
                                :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                class="dark:text-red-700"
                                :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                            </svg>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                    }"
                    class="lg:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Panel de información
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('homeworks.no-collaboration')"
                        :active="route().current('homeworks.*')"
                    >
                        Mis tareas
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('collaborations.index')"
                        :active="route().current('collaborations.*')"
                    >
                        Colaborar
                    </ResponsiveNavLink>
                    <!-- <ResponsiveNavLink
                        :href="route('ranking.index')"
                        :active="route().current('ranking.*')"
                    >
                        Ranking
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('library.index')"
                        :active="route().current('library.*')"
                    >
                        Biblioteca
                    </ResponsiveNavLink> -->
                    <ResponsiveNavLink
                        :href="route('error-reports.index')"
                        :active="route().current('error-reports.*')"
                    >
                        Errores y sugerencias
                    </ResponsiveNavLink>
                    <!-- <ResponsiveNavLink
                        v-if="$page.props.auth.user.is_admin"
                        :href="route('admin.finances')"
                        :active="route().current('admin.*')"
                    >
                        Administrador
                    </ResponsiveNavLink> -->
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="shrink-0 mr-3"
                        >
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user?.name"
                        />
                        </div>

                        <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-300">
                            {{ $page.props.auth.user?.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1 dark:text-gray-400">
                        <ResponsiveNavLink
                        :href="route('profile.show')"
                        :active="route().current('profile.show')"
                        >
                        Perfil
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                        v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')"
                        :active="route().current('api-tokens.index')"
                        >
                        API Tokens
                        </ResponsiveNavLink>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                        <ResponsiveNavLink as="button" class="dark:text-gray-400">
                            Cerrar sesión
                        </ResponsiveNavLink>
                        </form>
                    </div>
                    </div>
                </div>
                </nav>
                <!-- content -->
                <div
                class="overflow-y-auto h-[calc(100vh-3rem)] transition-dark dark:bg-slate-900"
                >
                <slot />
                </div>
            </main>
            </div>
    </div>
</template>
