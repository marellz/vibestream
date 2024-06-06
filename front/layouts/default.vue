<template>
  <x-flex column class="h-[100vh]">
    <header class="border-b py-5">
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
        </x-flex>
      </x-container>
    </header>
    <main class="flex-auto py-10">
        <slot />
    </main>
    <footer class="border-t">
        <x-container class="py-4">
            <p class="text-center text-sm">Created by <a href="#">Dave</a> just for fun.</p>
        </x-container>
    </footer>
  </x-flex>
</template>
<script lang="ts" setup>
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
</script>
