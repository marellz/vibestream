<template>
  <div ref="wrapper" id="wrapper" class="flex flex-col h-[100vh]">
    <layouts-header @toggle-nav="toggleNav" />
    <main class="flex-auto">
      <x-container class="flex relative">
        <layouts-navigation @toggle-nav="toggleNav" :active="navActive" />
        <div class="flex-auto">
          <slot />
        </div>

        <x-button
          v-show="pageIsScrolled"
          class="fixed right-10 bottom-10"
          @click="scrollToTop"
        >
          <BarsArrowUpIcon class="h-5" />
        </x-button>
      </x-container>
    </main>
    <layouts-footer />
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import { BarsArrowUpIcon } from "@heroicons/vue/24/outline";
import { useScroll } from "@vueuse/core";
const auth = useAuthStore();

onBeforeMount(() => {
  auth.initialize();
});

const wrapper = ref();
const navActive = ref(false);
const { x, y } = useScroll(wrapper, { behavior: "smooth" });
const pageIsScrolled = computed(() => y.value > 0);

const scrollToTop = () => {
  try {
    y.value = 0;
  } catch (error) {
    console.error({ scroll: error });
  }
};

const toggleNav = () => {
  navActive.value = !navActive.value;
};
</script>
