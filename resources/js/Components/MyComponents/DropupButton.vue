<template>
  <div class="flex flex-wrap">
    <div class="pl-1">
      <div class="relative inline-flex align-middle w-full">
        <button
          class="btn-primary ease-linear transition-all duration-150"
          type="button"
          v-on:click="toggleDropdown()"
          ref="btnDropdownRef"
        >
          Acciones <i :class="active()"></i>
        </button>
        <div
          @click="dropdownPopoverShow = false"
          v-bind:class="{ hidden: !dropdownPopoverShow, block: dropdownPopoverShow }"
          class="border dark:border-indigo-700 bg-indigo-200 dark:bg-indigo-600 text-gray-700 text-base font-semibold z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
          style="min-width: 12rem"
          ref="popoverDropdownRef"
        >
          <slot name="links" />
          <!-- <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
          <a href="#pablo" class="hover:bg-indigo-200 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent">
            Seprated link
          </a> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { createPopper } from "@popperjs/core";

export default {
  name: "dropdown",
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
    toggleDropdown: function () {
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "top-end",
        });
      }
    },
    active() {
      if (this.dropdownPopoverShow) {
        return "fa-solid fa-angle-down";
      } else {
        return "fa-solid fa-angle-up";
      }
    },
  },
};
</script>
