<template>
    <div class="bg-white rounded-lg shadow-md px-3 py-2 dark:bg-slate-800">
        <div class="text-indigo-500 text-center text-lg py-1 border-b">
            <slot name="title" />
        </div>
        <div class="overflow-auto dark:text-gray-300 text-gray-600 pt-1 h-22">
            <div class="text-sm">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // props:{
    //     value: String,
    // }
}
</script>
