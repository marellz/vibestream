<template>
  <header class="border-b py-5 sticky top-0 bg-white z-10">
    <x-container>
      <x-flex class="items-center">
        <button type="button" class="md:hidden p-2 mr-5" @click="toggleNav">
          <Bars3BottomLeftIcon class="h-7" />
        </button>
        <x-logo />
        <x-flex wrapper="ul" items-center class="ml-auto">
          <li class="font-medium">
            <template v-if="isAuthenticated">
              <dropdown-menu>
                <template #header>
                  <img
                    v-if="user?.avatar"
                    :src="user?.avatar"
                    class="h-5 w-5 rounded-full object-cover"
                  />
                  <UserCircleIcon v-else class="h-5" />
                  <p class="hidden md:block">
                    {{ user?.name ?? "no name" }}
                  </p>
                </template>
                <dropdown-link to="/user/profile">
                  <span>My profile</span>
                </dropdown-link>
                <dropdown-item
                  class="!text-red-500"
                  wrapper="a"
                  href="#"
                  @click.prevent="logout"
                >
                  Logout
                </dropdown-item>
              </dropdown-menu>
            </template>
            <template v-else>
              <nuxt-link to="/auth/login">Login</nuxt-link>
            </template>
          </li>
        </x-flex>
      </x-flex>
    </x-container>
  </header>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import { useUserStore } from "~/store/user";
import { Bars3BottomLeftIcon, UserCircleIcon } from "@heroicons/vue/24/outline";
const emit = defineEmits(['toggle-nav'])
const logout = () => auth.logout();
const auth = useAuthStore();
const userStore = useUserStore();
const isAuthenticated = computed(() => auth.authenticated);
const user = computed(() => userStore.user);
const toggleNav = () => {
  emit('toggle-nav')
}
</script>
