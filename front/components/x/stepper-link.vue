<template>
  <nuxt-link
    class="inline-flex items-center"
    v-bind="$attrs"
    v-slot="{ navigate }"
    exact-active-class="font-bold"
    :class="{ 'text-gray-500': disabled }"
  >
    <button @click="navigate" :disabled>
      <span>
        <slot />
      </span>
    </button>
  </nuxt-link>
</template>
<script lang="ts" setup>
defineProps<{
  disabled?: boolean;
}>();
</script>
