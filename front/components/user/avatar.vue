<template>
  <div>
    <img
      v-if="avatar"
      :src="avatar"
      :class="size"
      class="rounded-full object-cover"
    />
    <UserCircleIcon v-else :class="size" class="text-gray-200" />
  </div>
</template>
<script lang="ts" setup>
import { UserCircleIcon } from "@heroicons/vue/24/solid";

withDefaults(
  defineProps<{
    avatar?: string;
    size?: string;
  }>(),
  {
    size: "h-12 w-12",
  }
);
</script>
