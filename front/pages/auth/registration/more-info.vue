<template>
  <x-auth-form width="max-w-[500px]">
    <div class="mb-5 space-y-2">
      <x-title>Registration</x-title>
      <p class="text-gray-500">Adding more information to your user profile</p>
    </div>
    <form @submit.prevent="submit">
      <div class="space-y-5">
        <form-avatar />
        <form-input v-model="form.phone_number" label="Phone"></form-input>
        <form-select
          label="Gender"
          placeholder="Select your gender"
          v-model="form.gender"
          :options="options.genders"
        ></form-select>
        <form-textarea label="Bio" v-model="form.bio" />
        <form-group label="Interests">
          <div class="flex flex-wrap">
            <form-checkbox
              v-model="interests"
              v-for="(item, index) in options.interests"
              :key="index"
              name="interests"
              :input-value="item.value"
              class="mb-2 mr-2"
            >
              {{ item.label }}
            </form-checkbox>
          </div>
        </form-group>
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
import { useOptionsStore } from "~/store/options";
import { useUserStore } from "~/store/user";
import type { User } from "~/types/user";

definePageMeta({
  middleware: "auth",
});

const options = useOptionsStore();
const userStore = useUserStore();
const router = useRouter();

const form = ref<Partial<User>>({});
const interests = ref([]);

const user = computed(() => userStore.user);

const submit = async () => {
  const _user = user.value;
  const updated = await userStore.updateUser({ ..._user, ...form.value });

  if (updated) {
    router.push("/auth/registration/following");
  }
};

onMounted(async () => {
  await userStore.getUser();
  if (user.value) {
    form.value = user.value;
  }
});
</script>
