<template>
  <div class="relative" ref="dropdown" v-bind="$attrs">
    <div>
      <button
        type="button"
        class="w-full flex items-center space-x-2 px-3 py-2"
        @click="active = !active"
      >
        <slot name="header"/>
        <ChevronDownIcon class="h-4" />
      </button>
    </div>
    <div
      class="border rounded absolute top-full w-full max-w-64 right-0 overflow-hidden"
      v-show="active"
    >
      <slot />
    </div>
  </div>
</template>
<script lang="ts" setup>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
import { onClickOutside } from "@vueuse/core";

const dropdown = ref(null);
const active = ref<boolean>(false);

onClickOutside(dropdown, (event) => {
  active.value = false;
});
</script>
