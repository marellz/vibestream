<template>
  <form-avatar class="mb-10" />
  <form @submit.prevent="submit" v-if="form">
    <div class="space-y-5">
      <form-input v-model="form.name" required label="Name"></form-input>
      <form-input
        v-model="form.email"
        required
        type="email"
        label="Email"
      ></form-input>
      <x-flex class="justify-end">
        <x-button>Save changes</x-button>
      </x-flex>
    </div>
  </form>
</template>
<script lang="ts" setup>
import type { UserBasicForm } from "~/types/user";
import { useUserStore } from "~/store/user";

const store = useUserStore();

const form = ref<UserBasicForm | null>(null);
const submit = () => {
  if (form.value) {
    store.updateUser(form.value);
  }
};

const getUser = async () => {
  let user = await store.getUser();
    form.value = user
}

onMounted(getUser);
</script>
