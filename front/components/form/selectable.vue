<template>
  <span
    class="bg-gray-100 py-1 px-3 text-sm rounded-xl select-none"
    :class="{ '!bg-blue-300': selected, 'opacity-50': disabled }"
  >
    <slot />
  </span>
</template>
<script lang="ts" setup>
defineProps<{
  disabled?: boolean;
  selected?: boolean;
}>();
</script>
