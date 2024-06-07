<template>
  <nuxt-link
    class="flex items-center space-x-2 px-3 py-2 bg-white hover:bg-slate-100"
    :to
  >
    <slot />
  </nuxt-link>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    to?: string;
  }>(),
  {
    to: "#",
  }
);
</script>
