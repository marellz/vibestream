<template>
    <div class="mx-auto p-5 bg-white border rounded-xl" :class="width">
        <slot />
    </div>
</template>
<script lang="ts" setup>
withDefaults(defineProps<{
    width?: string,
}>(), {
    width: 'max-w-96'
})
</script>