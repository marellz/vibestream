<template>
  <button
    :type
    :disabled
    @click="()=>$emit('click')"
    class="bg-white space-x-2 inline-flex items-center justify-center border rounded py-2 px-4 border-gray-400 disabled:border-gray-300 disabled:text-gray-300"
  >
    <slot />
  </button>
</template>
<script lang="ts" setup>
defineEmits(['click'])
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
