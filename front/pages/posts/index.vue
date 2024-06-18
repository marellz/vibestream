<template>
  <x-wrap>
    <template v-if="isAuthenticated">
      <x-title>Hello {{ userStore.firstName }}!</x-title>
      <p>Welcome back to VibeStream!</p>
    </template>
    <template v-else>
      <x-flex items-center>
        <div class="flex-auto">
          <x-title>Stream Your Vibes</x-title>
          <p>Share, Connect, and Enjoy!</p>
        </div>
        <div>
          <nuxt-link to="/auth/login">
            <x-button>
              <span>Login to post</span>
              <ArrowRightEndOnRectangleIcon class="h-5" />
            </x-button>
          </nuxt-link>
        </div>
      </x-flex>
    </template>
    <x-content>
      <template v-if="isAuthenticated">
        <post-new />
      </template>

      <hr class="my-10" />

      <div class="space-y-4" v-if="!pending">
        <post-item :data="post" v-for="post in posts" :key="post.id" />
      </div>
      <div v-else>
        <p class="text-4xl">Pending</p>
      </div>
    </x-content>
  </x-wrap>
</template>
<script lang="ts" setup>
import { usePostsStore } from "@/store/posts";
import { useAuthStore } from "~/store/auth";
import { useUserStore } from "~/store/user";

import { ArrowRightEndOnRectangleIcon } from "@heroicons/vue/24/outline";

const store = usePostsStore();
const auth = useAuthStore();
const userStore = useUserStore()

const { pending } = await useAsyncData("getPosts", () => store.getPosts());

const posts = computed(() => store.posts);
const user = computed(() => userStore.user);
const isAuthenticated = computed(() => user.value && auth.authenticated);
</script>
