<template>
  <div class="border rounded-lg p-2">
    <x-flex items-center class="space-x-3">
      <user-avatar :avatar="user.avatar" />
      <nuxt-link :to="`/profile/${user.username}`" class="flex-auto">
        <p class="font-medium text-lg">
          {{ user.name }}
        </p>
        <p class="text-sm text-gray-500">@{{ user.username }}</p>
        <!-- <p class="text-sm text-gray-500">
                  12 mutual followers
              </p> -->
      </nuxt-link>
      <div class="x-flex px-5" v-if="auth.authenticated">
        <button
          v-if="user.i_follow"
          type="button"
          class="border border-transparent hover:text-red-500 hover:border-red-500 rounded p-1"
          @click="unfollow"
        >
          <UserMinusIcon class="h-6" />
        </button>
        <button
          v-else
          type="button"
          class="border border-transparent hover:text-red-500 hover:border-red-500 rounded p-1"
          @click="follow"
        >
          <UserPlusIcon class="h-6" />
        </button>
      </div>
    </x-flex>
  </div>
</template>
<script lang="ts" setup>
import { UserMinusIcon, UserPlusIcon } from "@heroicons/vue/24/outline";
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
