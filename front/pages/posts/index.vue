<template>
  <x-wrap ref="container" class="h-full overflow-auto">
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

      

      <feed-filter class="mb-4" v-if="isAuthenticated" @refresh="refresh" :disabled="pending"/>

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
import { useFeedStore } from "@/store/feed";
import { useAuthStore } from "~/store/auth";
import { useUserStore } from "~/store/user";

import { ArrowRightEndOnRectangleIcon } from "@heroicons/vue/24/outline";

const store = useFeedStore();
const auth = useAuthStore();
const userStore = useUserStore()
const container = ref()
const { pending, data: posts, refresh } = await useAsyncData("getFeed", () => store.getPosts());

const user = computed(() => userStore.user);
const isAuthenticated = computed(() => user.value && auth.authenticated);


onMounted(refresh)
</script>
