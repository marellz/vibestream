<template>
  <div>
    <div class="w-2/3 mx-auto text-center">
      <h1 class="text-8xl">
        <span class="text-3xl">Welcome to</span><br />
        <span class="font-bold"> VibeStream </span>
      </h1>
      <x-content>
        <p class="font-normal">
          At VibeStream, we believe in creating a vibrant and inclusive
          community where everyone can share their stories, connect with others,
          and spread good vibes. Whether you're here to make new friends,
          showcase your creativity, or just have a good time, VibeStream is your
          go-to platform for all things fun and friendly.
        </p>
      </x-content>
      <x-content>
        <x-flex items-center justify-center class="space-x-3">
          <template v-if="auth.authenticated">
            <nuxt-link to="/posts">
              <x-button>Posts</x-button>
            </nuxt-link>
            <nuxt-link to="/events">
              <x-button>Events</x-button>
            </nuxt-link>
          </template>
          <template v-else>
            <nuxt-link to="/auth/registration">
              <x-button>Get started</x-button>
            </nuxt-link>
            <p>
              <span class="text-gray-600"> Already registered? </span>
              <nuxt-link to="/auth/login">
                <span>Login</span>
              </nuxt-link>
            </p>
          </template>
        </x-flex>
      </x-content>
    </div>
  </div>
</template>
<script lang="ts" setup>
definePageMeta({
  layout: "home"
})
import { useAuthStore } from "~/store/auth";

const auth = useAuthStore();
</script>
