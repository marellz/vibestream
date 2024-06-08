<template>
  <x-container>
    <div class="w-1/2 mx-auto">
      <x-title>User profile</x-title>
      <x-content>
        <form @submit.prevent="submit" v-if="form">
          <div class="space-y-5">
            <form-input v-model="form.name" required label="Name"></form-input>
            <form-input
              v-model="form.email"
              required
              label="Email"
            ></form-input>
            <x-flex class="justify-end">
              <x-button>Save changes</x-button>
            </x-flex>
          </div>
        </form>
      </x-content>
    </div>
  </x-container>
</template>
<script lang="ts" setup>
import { useAuthStore } from "~/store/auth";
import type { User } from "~/types/user";
const auth = useAuthStore();
const form = ref<User|null>(null)

onMounted(async () => {
   form.value = await auth.getUser()
});

const submit = () => {
    if(form.value){
        auth.updateUser(form.value)
    }
};
</script>
