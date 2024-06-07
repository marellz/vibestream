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
const auth = useAuthStore()
const content = defineModel<string>();
const store = usePostsStore();
const emit = defineEmits(["submit"]);
const submit = async () => {
  if (content.value) {
    const success = await store.createPost({ content: content.value });
    if (success) {
      content.value = "";
    }
  }
};

const firstName = computed(()=> auth.user?.name.split(' ')[0])
</script>
