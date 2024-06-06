<template>
  <component
    :is="wrapper"
    class="flex"
    :class="{
      'items-center': itemsCenter,
      'justify-center': justifyCenter,
      'flex-col': column,
      'flex-wrap': wrap,
    }"
  >
    <slot />
  </component>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    itemsCenter?: boolean;
    justifyCenter?: boolean;
    column?: boolean;
    wrap?: boolean;
    wrapper?: string,
  }>(),
  {
    itemsCenter: false,
    justifyCenter: false,
    column: false,
    wrap: false,
    wrapper: 'div'
  }
);
</script>
