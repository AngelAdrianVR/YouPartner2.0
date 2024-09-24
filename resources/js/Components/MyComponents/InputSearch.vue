<template>
	<fieldset class="w-full space-y-1">
		<div class="relative">
			<Input type="search" @keyup.enter="search" v-model="search_text" placeholder="Buscar..."
				class="py-2 pr-10 text-sm rounded-md w-full dark:bg-slate-800 dark:border dark:text-gray-300 dark:border-slate-700" />
			<span class="absolute inset-y-0 right-0 flex items-center pr-2">
				<button @click="search" type="button" title="Buscar" class="p-1 focus:outline-none focus:ring">
					<i class="fa-solid fa-magnifying-glass text-gray-500"></i>
				</button>
			</span>
		</div>
	</fieldset>
</template>

<script>
import Input from "@/Components/Input.vue";
import pickBy from "lodash/pickBy";

export default {
	data() {
		return {
			search_text: this.filters.search,
		}
	},
	components: {
		Input
	},
	methods: {
		search() {
			this.$inertia.get(this.filterURL, pickBy({ search: this.search_text }), { preserveState: true });
		}
	},
	props: {
		filters: {
			type: Object,
			default: {
				search: null
			}
		},
		filterURL: String
	}
}
</script>