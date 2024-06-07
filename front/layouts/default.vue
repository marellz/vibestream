<template>
  <div ref="wrapper" id="wrapper" class="flex flex-col h-[100vh] overflow-auto">
    <header class="border-b py-5 sticky top-0 bg-white z-10">
      <x-container>
        <x-flex>
          <nuxt-link to="/" class="text-2xl font-bold">VibeStream</nuxt-link>
          <x-flex wrapper="ul" items-center class="space-x-5 ml-5">
            <li v-for="(link, index) in links" :key="index">
              <nuxt-link :to="link.path">
                {{ link.label }}
              </nuxt-link>
            </li>
          </x-flex>
          <x-flex wrapper="ul" items-center class="ml-auto">
            <li v-if="isAuthenticated">
              <a href="#" @click.prevent="logout">Logout</a>
            </li>
            <li v-else>
              <nuxt-link to="/auth/login">Login</nuxt-link>
            </li>
          </x-flex>
        </x-flex>
      </x-container>
    </header>
    <main class="flex-auto py-10 relative">
      <slot />

      <x-button
        v-show="pageIsScrolled"
        class="fixed right-10 bottom-10"
        @click="scrollToTop"
      >
        <BarsArrowUpIcon class="h-5" />
      </x-button>
    </main>
    <footer class="border-t">
      <x-container class="py-4">
        <p class="text-center text-sm">
          Created by <a href="#">Dave</a> just for fun.
        </p>
      </x-container>
    </footer>
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import { BarsArrowUpIcon } from "@heroicons/vue/24/outline";
import { useScroll } from "@vueuse/core";

const store = useAuthStore();
const isAuthenticated = computed(() => store.authenticated);
const logout = () => store.logout();
const links = [
  {
    path: "/posts",
    label: "Posts",
  },
  {
    path: "/events",
    label: "Events",
  },
  {
    path: "/status",
    label: "Status",
  },
];

const wrapper = ref();
const { x, y } = useScroll(wrapper, { behavior: "smooth"});
const pageIsScrolled = computed(() => y.value > 0);
const scrollToTop = () => {
  try {
    y.value = 0;
  } catch (error) {
    console.error({ scroll: error });
  }
};
</script>
