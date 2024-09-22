<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'w-full font-thin uppercase flex items-center p-4 my-1 transition-colors duration-200 justify-start text-indigo-500 bg-gradient-to-r from-white to-indigo-100 border-r-4 border-indigo-500 dark:from-gray-700 dark:to-gray-800'
        : 'w-full font-thin uppercase text-gray-500 dark:text-gray-200 flex items-center p-4 my-1 transition-colors duration-200 justify-start hover:text-indigo-500 hover:bg-indigo-50 dark:hover:bg-slate-600';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

