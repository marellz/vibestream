<template>
  <x-container>
    <x-title>Hello</x-title>
    <x-content>
      <p>App version is : {{ version ?? "--" }}</p>
      <x-button @click="request">request</x-button>
    </x-content>
  </x-container>
</template>
<script lang="ts" setup>
import { useGlobalStore } from "@/store/global";
const store = useGlobalStore();
onMounted(() => {
  store.getVersion();
});

const request = store.getVersion()
const version = computed(() => store.version);
</script>
