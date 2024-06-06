<template>
  <button
    :type
    :disabled
    class="border rounded py-2 px-4 border-gray-400 disabled:border-gray-300 disabled:text-gray-300"
  >
    <span>
      <slot />
    </span>
  </button>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    type?: "submit" | "button" | undefined;
    disabled?: boolean;
  }>(),
  {
    type: undefined,
    disabled: false,
  }
);
</script>
