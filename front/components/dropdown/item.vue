<template>
  <component
    class="flex items-center space-x-2 px-3 py-2 bg-white hover:bg-slate-100"
    :is="wrapper"
  >
    <slot />
  </component>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    wrapper?: string;
  }>(),
  {
    wrapper: "div",
  }
);
</script>
