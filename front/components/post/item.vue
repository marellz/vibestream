<template>
  <div class="border rounded-lg p-3">
    <h1 class="font-bold">
      {{ user.name }}
    </h1>
    <p class="text-sm">
      {{ post.created }}
    </p>
    <div class="mt-3">
      <p class="text-lg">
        {{ post.content }}
      </p>
    </div>
    <x-flex items-center class="mt-4 space-x-3">
      <post-button :label="post.likes"  @click="toggleLike">
        <HeartIconSolid class="h-5 text-red-500" v-if="post.liked && auth.authenticated"/>
        <HeartIcon class="h-5" v-else/>
      </post-button>
      <post-button :label="`${comments.length} comments`" @click="openComments">
        <ChatBubbleOvalLeftIcon class="h-5" />
      </post-button>
    </x-flex>

    <div class="mt-3 space-y-4" v-if="showComments">
      <post-comment-new :post-id="post.id" v-if="auth.authenticated" />
      <post-comment-item :data="comment" v-for="comment in comments"/>
    </div>
  </div>
</template>
<script lang="ts" setup>
import type { Post } from "~/types/post";
import { HeartIcon, ChatBubbleOvalLeftIcon } from "@heroicons/vue/24/outline";
import { HeartIcon as HeartIconSolid } from "@heroicons/vue/24/solid";
import { usePostsStore  } from "~/store/posts";
import { useAuthStore } from "~/store/auth";

const store = usePostsStore()
const auth = useAuthStore()
const props = defineProps<{
  data: Post;
}>();

const showComments = ref(false)
const post = computed(() => props.data);
const user = computed(() => props.data?.user);
const comments = computed(() => props.data?.comments ?? []);

const toggleLike = () => {
  store.likePost({post_id: post.value.id, liked: !post.value.liked})
}

const openComments = () => {
  showComments.value = !showComments.value
}
</script>
