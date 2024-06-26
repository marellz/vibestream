<template>
  <div>
    <x-stepper>
      <x-stepper-link
        v-for="(link, index) in links"
        :disabled="link.authenticated !== auth.authenticated"
        :to="`/auth/registration${link.path}`"
        :key="index"
      >
      {{  link.label }}
    </x-stepper-link>
    </x-stepper>
    <NuxtPage />
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from '~/store/auth';

const auth = useAuthStore()

definePageMeta({
  layout: "auth",
});

const links = [
  {
    path: "/",
    label: "Basic information",
    authenticated: false
  },
  {
    path: "/more-info",
    label: "More information",
    authenticated: true
  },
  {
    path: "/following",
    label: "Following",
    authenticated: true
  },
];
</script>
