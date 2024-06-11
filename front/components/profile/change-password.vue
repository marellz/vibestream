<template>
  <x-alert v-if="responseMessage" :variant="formError?'error':'success'">
    {{ responseMessage }}
  </x-alert>
  <form @submit.prevent="updatePassword">
    <div class="space-y-5">
      <form-input
        type="password"
        v-model="form.old_password"
        required
        label="Current password"
      ></form-input>
      <form-input
        type="password"
        v-model="form.new_password"
        required
        label="New password"
      ></form-input>
      <form-input
        type="password"
        v-model="form.new_password_confirmation"
        required
        label="Confirm password"
      ></form-input>
      <x-flex class="justify-end">
        <x-button>Update password</x-button>
      </x-flex>
    </div>
  </form>
</template>
<script lang="ts" setup>
import { useUserStore } from "~/store/user";
import type { NewPasswordForm } from "~/types/user";

const store = useUserStore();
const form = ref<NewPasswordForm>({
  old_password: "secret22",
  new_password: "secret21",
  new_password_confirmation: "secret21",
});
const formError = ref(false)
const responseMessage = ref<string | null>();
const updatePassword = async () => {
  let { message, success } : {message: string, success: boolean} = await store.updatePassword(form.value);
  if(!success){
    formError.value = true
  }
  responseMessage.value = message;
};
</script>
