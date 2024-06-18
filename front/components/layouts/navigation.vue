<template>
  <div
    ref="nav"
    class="fixed w-64 max-w-full left-0 h-full flex-none pr-5 bg-whitem border-r md:border-r-0 bg-white top-0 md:sticky md:top-[81px] z-50 md:w-40 md:z-auto
    transform -translate-x-full md:transform-none"
    :class="{ '!translate-x-0': active }"
  >
    <div class="flex justify-between items-center p-5">
      <x-title-sub>Menu</x-title-sub>
      <button
        type="button"
        class="md:hidden h-10 w-10 inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 focus:bg-gray-100 rounded-full"
        @click="toggleNav"
      >
        <ArrowLeftIcon class="h-6" />
      </button>
    </div>

    <nav class="flex flex-col space-y-1 py-5 px-5 md:px-0">
      <nuxt-link
        class="font-medium py-3 flex items-center space-x-5 border px-3 rounded-lg border-transparent w-48 md:w-auto"
        exact-active-class="border-gray-900"
        v-for="(link, index) in validLinks"
        :key="index"
        :to="link.path"
      >
        <component :is="link.icon" class="h-5 text-gray-600" />
        <span>
          {{ link.label }}
        </span>
      </nuxt-link>
    </nav>
  </div>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import {
  GlobeEuropeAfricaIcon,
  CalendarIcon,
  UserGroupIcon,
  LightBulbIcon,
  ArrowLeftIcon,
} from "@heroicons/vue/24/solid";
import { onClickOutside, useWindowScroll } from "@vueuse/core";

const { x, y } = useWindowScroll()

const props = withDefaults(
  defineProps<{
    active: boolean;
  }>(),
  {
    active: false,
  }
);

const emit = defineEmits(['toggle-nav'])
const auth = useAuthStore();

const nav = ref()
const links = [
  {
    path: "/posts",
    label: "Feed",
    icon: GlobeEuropeAfricaIcon,
  },
  {
    path: "/events",
    icon: CalendarIcon,
    label: "Events",
  },
  {
    path: "/followers",
    label: "Followers",
    icon: UserGroupIcon,
    requiresAuth: true,
  },
  {
    path: "/status",
    icon: LightBulbIcon,
    label: "Status",
  },
];

const validLinks = computed(() =>
  links.filter((l) => {
    return l.requiresAuth ? auth.authenticated : l;
  })
);

const toggleNav = () => {
  emit('toggle-nav')
}

onClickOutside(nav, (event) => {
  if(props.active){
    emit('toggle-nav')
  }
});
</script>
