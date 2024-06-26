<template>
  <x-auth-form width="max-w-[500px]">
    <div class="mb-5 space-y-2">
      <x-title>Registration</x-title>
      <p class="text-gray-500">Creating your user profile</p>
    </div>
    <form @submit.prevent="submit">
      <div class="space-y-5">
        <form-input
          label="Name"
          v-model="form.name"
          required
          :error="formErrors.name"
        />
        <form-input
          type="email"
          label="Email"
          v-model="form.email"
          required
          :error="formErrors.email"
        />
        <form-input
          type="password"
          label="Password"
          v-model="form.password"
          :error="formErrors.password"
          required
        />
        <form-input
          type="password"
          label="Confirm password"
          v-model="form.password_confirmation"
          required
        />
        <div class="flex justify-end">
          <x-button>
            <span>Next</span>
            <ArrowRightIcon class="h-5" />
          </x-button>
        </div>
      </div>
    </form>
  </x-auth-form>
</template>
<script lang="ts" setup>
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import { useAuthStore } from "~/store/auth";
import { useOnboardingStore } from "~/store/onboarding";
import type { UserRegistration } from "~/types/user";

definePageMeta({
  middleware: 'guest'
})

const router = useRouter();
const auth = useAuthStore();
const onboarding = useOnboardingStore();

const form = ref<UserRegistration>({
  name: "Daev Njoro",
  email: "dave@dave.com",
  password: "secret22",
  password_confirmation: "secret22",
});

interface FormError {
  name?: string;
  email?: string;
  password?: string;
}

const formErrors = ref<FormError>({});

const submit = async () => {
  formErrors.value = {}
  try {
    let success = await onboarding.register(form.value);
    if (success) {
      router.push("/auth/registration/more-info");
    } else {
      // todo: handle if success is false
    }
  } catch (error: any) {
    if (error.errors) {
      let _errs = error.errors;
      for (const key in _errs) {
        if (Object.prototype.hasOwnProperty.call(_errs, key)) {
          formErrors.value[key as keyof FormError] = _errs[key][0];
        }
      }
    }
  }
};
</script>
