<template>
  <x-title-sub>People following me</x-title-sub>
  <x-content>
    <template v-if="users && users.length">
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <user-item v-for="(user, index) in users" :user="user" :key="index" />
      </div>
    </template>
    <template v-else-if="pending">
      <p>Wait a second, fetching them.</p>
    </template>
    <template v-else-if="error">
      <p>Error displaying these nice people.</p>
    </template>
  </x-content>
</template>
<script lang="ts" setup>
import { useUserStore } from "~/store/user";

const props = defineProps<{
  username: string | string[];
}>();

const store = useUserStore();
const {
  data: users,
  error,
  pending,
  refresh,
} = useAsyncData(
  `getFollowers:${props.username}`,
  async () => await store.getFollowers(props.username)
);

onMounted(refresh);
</script>
