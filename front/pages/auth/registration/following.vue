<template>
  <div>
    <x-auth-form width="max-w-[800px]">
      <div class="mb-5 space-y-2">
        <x-title>Following</x-title>
        <p class="text-gray-500">Getting some followers for your feed</p>
      </div>
      <div v-if="users.length" class="grid lg:grid-cols-2 gap-5">
        <user-item
          @refresh="store.spliceUser(index)"
          :user="user"
          v-for="(user, index) in users"
          :key="user.id"
        />
      </div>
      <div v-else>
        <div class="text-center space-y-3 py-10">
          <p>Want to follow more users?</p>
          <x-button class="!border-none text-blue-500 hover:bg-blue-100" @click="refresh">
            <span>Refresh</span>
            <ArrowPathIcon class="h-5" />
          </x-button>
        </div>
      </div>
      <div class="flex justify-end mt-5">
        <x-button @click="next">
          <span>Next</span>
          <ArrowRightIcon class="h-5" />
        </x-button>
      </div>
    </x-auth-form>
  </div>
</template>
<script lang="ts" setup>
import { useFollowingStore } from "~/store/follows";
import { ArrowRightIcon, ArrowPathIcon } from "@heroicons/vue/24/outline";
definePageMeta({
  middleware: "auth",
});
const store = useFollowingStore();
const users = computed(() => store.users);
const refresh = () => store.getFollowingSuggestions()

const next = () => {
  useRouter().push("/posts");
};

onMounted(refresh);
</script>
