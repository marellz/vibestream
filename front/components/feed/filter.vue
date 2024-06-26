<template>
  <div
    class="inline-flex items-center bg-gray-100 relative rounded-lg p-1 shadow-inner"
    :class="{'opacity-10 cursor-wait': disabled}"
  >
    <div v-for="item in criteria" :key="item">
      <input
        class="h-0 w-0 absolute opacity-0"
        type="radio"
        name="feed_type"
        :disabled
        :value="item"
        :id="`feed-${item}`"
        v-model="model"
      />
      <label :for="`feed-${item}`">
        <div
          class="p-2 rounded-lg"
          :class="{ 'bg-white border': model === item }"
        >
          {{ item }}
        </div>
      </label>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { useFeedStore, type FeedType } from "~/store/feed";
const criteria = ["latest", "popular", "friends", "default"];
const store = useFeedStore();
const model = defineModel<FeedType>({
  default: "default",
});

withDefaults(defineProps<{
    disabled?: boolean
}>(), {
    disabled: false
})
const emit = defineEmits(["refresh"]);
watch(
  () => model.value,
  (v) => {
    if (v) {
      store.updateFeed(v);
      emit('refresh')
    }
  }
);
onMounted(() => {
  model.value = "default";
});
</script>
