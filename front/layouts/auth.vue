<template>
  <div class="h-[100vh] flex flex-col">
    <main class="flex-auto min-h-[200px]">
      <div class="flex justify-center bg-gray-50 py-8">
        <x-logo />
      </div>
      <div class="h-48 bg-gray-50 pt-8">
        <slot />
      </div>
    </main>
    <layouts-footer />
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from '~/store/auth';

const auth = useAuthStore()

onBeforeMount(() => {
  auth.initialize();
});

</script>
