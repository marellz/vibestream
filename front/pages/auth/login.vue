<template>
  <x-container>
    <div class="w-1/4 mx-auto">
      <form @submit.prevent="login">
        <div class="p-4 space-y-5">
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
    </div>
  </x-container>
</template>
<script lang="ts" setup>
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import { useAuthStore } from "~/store/auth";

definePageMeta({
  middleware: "guest",
});

const store = useAuthStore();
const router = useRouter();
const credentials = ref({
  email: "test@example.com",
  password: "secret",
});

const login = async () => {
  let success = await store.login(credentials.value);
  if (success) {
    await router.push("/posts");
  }
};
</script>
