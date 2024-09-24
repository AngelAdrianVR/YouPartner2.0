<template>
    <div class="bg-white rounded-lg shadow-md px-3 py-2 dark:bg-slate-800">
        <div class="text-indigo-500 text-center text-lg py-1 border-b">
            <slot name="title" />
        </div>
        <div class="overflow-auto text-gray-600 dark:text-gray-300 pt-1 max-h-40">
            <div v-if="items?.length" class="text-sm">
                <slot name="content" />
            </div>
            <div v-else class="text-sm text-center text-gray-400 font-semibold flex flex-col">
                <span>Sin información</span>
                <i class="fa-regular fa-face-grin-beam-sweat text-5xl text-gray-300 mt-1"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        items: Array,
    },
}
</script>
