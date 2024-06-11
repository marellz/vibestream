<template>
  <div class="rounded border p-2 mb-10"
  :class="variants[variant]">
    <p>
      <slot />
    </p>
  </div>
</template>
<script lang="ts" setup>
withDefaults(
  defineProps<{
    variant: "info" | "error";
  }>(),
  {
    variant: "info",
  }
);

const variants = {
  error: "border-red-500 bg-red-50 text-red-500",
  info: "border-blue-500 bg-blue-50 text-blue-500",
  success: "border-green-500 bg-green-50 text-green-500",
};
</script>
