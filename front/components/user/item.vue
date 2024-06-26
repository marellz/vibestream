<template>
  <div class="border rounded-lg p-2">
    <x-flex items-center class="space-x-2 lg:space-x-3">
      <user-avatar class="flex-none" :avatar="user.avatar" />
      <nuxt-link :to="`/profile/${user.username}`" class="flex-auto">
        <p class="font-medium text-lg">
          {{ user.name }}
        </p>
        <p class="text-sm text-gray-500">@{{ user.username }}</p>
        <!-- <p class="text-sm text-gray-500">
                  12 mutual followers
              </p> -->
      </nuxt-link>
      <div class="x-flex" v-if="auth.authenticated">
        <button
          v-if="user.is_following"
          type="button"
          class="text-red-500 hover:bg-red-100 px-2 py-px rounded text-sm font-medium"
          @click="unfollow"
        >
          <span>Unfollow</span>
        </button>
        <button
          v-else
          type="button"
          class="text-blue-500 hover:bg-blue-100 px-2 py-px rounded text-sm font-medium"
          @click="follow"
        >
          <span>Follow</span>
        </button>
      </div>
    </x-flex>
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import { useUserStore } from "~/store/user";
import type { UserProfile } from "~/types/user";
const auth = useAuthStore();
const store = useUserStore();
const props = defineProps<{
  user: UserProfile;
}>();

const emit = defineEmits(['refresh'])

const follow = async () => {
  const success = await store.follow(props.user.username);
  if(success){
    emit('refresh')
  }
};
const unfollow = async () => {
  const success = await store.unfollow(props.user.username);
  if(success){
    emit('refresh')

  }
};
</script>
