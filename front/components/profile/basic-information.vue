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
      <form-input
        v-model="form.phone_number"
        label="Phone"
      ></form-input>
      <form-select
        label="Gender"
        placeholder="Select your gender"
        v-model="form.gender"
        :options="genderOptions"
      ></form-select>
      <form-textarea label="Bio" placeholder="A little something about you" v-model="form.bio"></form-textarea>
      <x-flex class="justify-end">
        <x-button>Save changes</x-button>
      </x-flex>
    </div>
  </form>
</template>
<script lang="ts" setup>
import type { User } from "~/types/user";
import { useUserStore } from "~/store/user";

const store = useUserStore();

const form = ref<User | null>();
const submit = () => {
  if (form.value) {
    store.updateUser(form.value);
  }
};

const getUser = async () => {
  let user = await store.getUser();
  form.value = user;
};

const genderOptions = ref([
  {
    label: 'Male',
    value: 'male'
  },
  {
    label: 'Female',
    value: 'female'
  },
  {
    label: 'Other',
    value: 'other'
  },
  {
    label: 'Prefer not to say',
    value: 'undisclosed'
  },
])

onMounted(getUser);
</script>
