<template>
  <div ref="wrapper" id="wrapper" class="flex flex-col h-[100vh]">
    <layouts-header />
    <main class="flex-auto">
        <slot />
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
