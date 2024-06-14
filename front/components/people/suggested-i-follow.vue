<template>
  <x-title-sub>Follower suggestion</x-title-sub>
  <x-content>
    <template v-if="users && users.length">
      <div class="column columns-3">
        <div class="col-span space-y-4">
          <user-item v-for="(user, index) in users" :user="user" :key="index" />
        </div>
      </div>
    </template>
    <template v-else-if="pending">
      <p>Wait a second, fetching them.</p>
    </template>
    <template v-if="error">
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
  `getSuggestedFollowing:${props.username}`,
  async () => await store.getSuggestedFollowing(props.username)
);

onMounted(refresh);
</script>
