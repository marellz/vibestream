<template>
  <div class="bg-gray-100 rounded-lg p-3">
    <x-flex items-center class="space-x-2">
      <user-avatar size="h-8 w-8" :avatar="user.avatar"/>
      <div>
        <p class="text-sm font-medium">
          {{ user.name }}
        </p>
        <p class="text-xs text-gray-500">{{ comment.created }}</p>
      </div>
    </x-flex>

    <div class="py-2">
      <p>
        {{ comment.content }}
      </p>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { type Comment } from "~/types/comment";
const props = defineProps<{
  data: Comment;
}>();

const comment = computed(() => props.data);
const user = computed(() => props.data?.user);
</script>
