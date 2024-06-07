<template>
  <div>
    <form @submit.prevent="submit">
      <x-flex items-center class="relative">
        <textarea
          ref="textarea"
          class="border rounded w-full p-4 pr-10 min-h-[58px] max-h-[200px]"
          v-model="content"
          :style="{height}"
          rows="1"
          :placeholder="`Reply as ${auth.firstName}`"
        ></textarea>
        <x-button class="absolute right-2 z-10 border-none">
          <PaperAirplaneIcon class="h-5" />
        </x-button>
      </x-flex>
    </form>
  </div>
</template>
<script lang="ts" setup>
import { PaperAirplaneIcon } from "@heroicons/vue/24/outline";
import { useAuthStore } from "~/store/auth";
import { usePostsStore } from "~/store/posts";

const props = defineProps<{
  postId: number;
}>();

const textarea = ref<HTMLElement | null>(null);
const height = ref<string|number>("auto");
const content = defineModel<string>();
const emit = defineEmits(["submit"]);
const store = usePostsStore();
const auth = useAuthStore();
const submit = async () => {
  if (content.value?.length) {
    let success = await store.createComment({
      post_id: props.postId,
      content: content.value,
    });

    if (success) {
      content.value = "";
    }
  }
};

watch(
  () => content.value,
  (v2) => {
    if(v2==='' || v2===null){
      height.value = 'auto'
    } else {
      if(textarea.value){
        height.value = `${textarea.value?.scrollHeight + 2}px`
      }
    }
  }
);
</script>
