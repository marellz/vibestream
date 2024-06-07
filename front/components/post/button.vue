<template>
<button type="button"class="flex items-center space-x-1 border p-2 rounded hover:border-red-500">
    <slot />
    <span class="text-sm font-bold">{{ label }}</span>
</button>
</template>
<script lang="ts" setup>
defineProps<{
    label?: string|number;
}>()
</script>