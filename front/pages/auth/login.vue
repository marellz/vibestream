<template>
  <x-auth-form>
    <x-title class="mb-5">Login</x-title>
    <form @submit.prevent="login">
      <div class="space-y-5">
        <form-input
          placeholder="Email"
          type="email"
          v-model="credentials.email"
        />
        <form-input
          placeholder="Password"
          type="password"
          v-model="credentials.password"
        />
        <x-button class="w-full">
          <span>Login</span>
          <ArrowRightIcon class="h-5" />
        </x-button>
      </div>
    </form>
  </x-auth-form>
</template>
<script lang="ts" setup>
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import { useAuthStore } from "~/store/auth";

definePageMeta({
  middleware: "guest",
  layout: "auth",
});

const store = useAuthStore();
const router = useRouter();
const credentials = ref({
  email: "test@example.com",
  password: "secret21",
});

const login = async () => {
  let success = await store.login(credentials.value);
  if (success) {
    await router.push("/posts");
  }
};
</script>
