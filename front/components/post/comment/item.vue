<template>
  <div class="bg-gray-50 p-3">
    <p class="text-sm">
      {{ user.name }}
    </p>
    <p class="text-xs">{{ comment.created }}</p>
    <div class="py-2">
      <p>
        {{ comment.content }}
      </p>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { type Comment } from '~/types/comment'
const props = defineProps<{
  data: Comment;
}>();

const comment = computed(() => props.data)
const user = computed(() => props.data?.user)

</script>
