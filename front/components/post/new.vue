<template>
  <div>
    <form @submit.prevent="submit">
      <textarea
        class="border rounded w-full p-4"
        v-model="content"
        rows="2"
        :placeholder="`What is on your mind, ${firstName}?`"
      ></textarea>
      <x-button>
        <PaperAirplaneIcon class="h-5" />
        <span>Send it!</span>
      </x-button>
    </form>
  </div>
</template>
<script lang="ts" setup>
import { PaperAirplaneIcon } from "@heroicons/vue/24/outline";
import { useAuthStore } from "~/store/auth";
import { usePostsStore } from "~/store/posts";
import { useUserStore } from "~/store/user";
const auth = useAuthStore()
const content = defineModel<string>();
const store = usePostsStore();
const user = useUserStore()
const emit = defineEmits(["submit"]);
const submit = async () => {
  if (content.value) {
    const success = await store.createPost({ content: content.value });
    if (success) {
      content.value = "";
    }
  }
};

const firstName = computed(()=> user.firstName)
</script>
