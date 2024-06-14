<template>
  <x-container>
    <x-tabs :tabs="tabs">
      <template #followers>
        <people-that-follow-me :username/>
      </template>
      <template #following>
        <people-that-i-follow :username/>
        <people-suggested-i-follow :username/>
      </template>
    </x-tabs>
  </x-container>
</template>
<script lang="ts" setup>
import { useUserStore } from "~/store/user";
import type { UserProfile } from "~/types/user";

const store = useUserStore()
const followers = ref<UserProfile[]>([]);
const username = computed(() => store.user?.username ?? null);


const activeTab = ref("following");

const tabs = [
  {
    key: "following",
    label: "People I follow",
  },
  {
    key: "followers",
    label: "People that follow me",
  },
];
// onMounted(getFollowers);
</script>
