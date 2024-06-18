<template>
  <x-wrap>
    <x-title>User profile</x-title>
    <x-content>
      <x-tabs :tabs="profileTabs">
        <template #basic-info>
          <profile-basic-information />
        </template>
        <template #more-info>
          <div>
            <profile-more-information />
          </div>
        </template>
        <template #password>
          <profile-change-password />
        </template>
      </x-tabs>
    </x-content>
  </x-wrap>
</template>
<script lang="ts" setup>
definePageMeta({
  middleware: "auth",
});

const profileTabs = ref([
  {
    key: "basic-info",
    label: "Basic information",
  },
  {
    key: "more-info",
    label: "More information",
  },
  {
    key: "password",
    label: "Password",
  },
]);
</script>
