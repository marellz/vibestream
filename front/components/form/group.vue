<template>
<x-flex column>
    <label>{{  label }}</label>
    <div>
        <slot />
    </div>
</x-flex>
</template>
<script lang="ts" setup>
defineProps<{
    label?: string;
}>()
</script>