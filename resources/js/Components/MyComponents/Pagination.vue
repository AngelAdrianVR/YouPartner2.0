<template>
  <nav
    v-if="pagination.meta.links.length > 3"
    aria-label="Pagination"
    class="inline-flex -space-x-px rounded-md shadow-sm mb-2"
  >
    <template v-for="(link, key) in pagination.meta.links">
      <div
        :key="key"
        v-if="link.url == null"
        class="inline-flex items-center px-3 py-2 text-sm border dark:border-slate-800 text-gray-400 dark:text-gray-300"
        v-html="link.label"
      ></div>
      <Link
        :key="'link-' + key"
        v-else
        :href="link.url"
        class="inline-flex items-center px-3 py-2 text-sm font-semibold border dark:border-slate-800 dark:text-gray-300"
        :class="link.active ? 'dark:bg-slate-700 bg-indigo-200 text-gray-900  ' : ''"
        v-html="link.label"
      />
    </template>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    Link,
  },
  props: {
    pagination: Object,
  },
};
</script>

<style></style>
