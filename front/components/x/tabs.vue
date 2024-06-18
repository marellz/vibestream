<template>
  <div>
    <ul class="flex items-baseline border-b border-b-gray-200 flex-wrap lg:flex-nowrap">
      <li
        v-for="tab in tabs"
        :key="`tab-${tab.key}`"
        class="px-3 first:pl-0 border-b -mb-px py-4 whitespace-nowrap"
        :class="{ 'border-b-gray-900 font-bold': activeTab === tab.key }"
      >
        <nuxt-link :to="`?tab=${tab.key}`" @click.prevent="switchTab(tab.key)">
          {{ tab.label }}
        </nuxt-link>
      </li>
    </ul>
    <div class="relative">
      <x-content>
        <slot :name="activeTab" />
      </x-content>
    </div>
  </div>
</template>
<script lang="ts" setup>
import type { LocationQueryValue } from 'vue-router';

interface TabItem {
  key: string;
  label: string;
}

const route = useRoute();
const props = defineProps<{
  tabs: TabItem[];
  defaultTab?: string;
}>();

onMounted(() => {

  if (props.defaultTab && props.tabs.find((t) => t.key === props.defaultTab)) {
    activeTab.value = props.defaultTab;
  }

  if(route.query) {
    let tabKey = route.query.tab?.slice(1)
    if ( props.tabs.find((t) => t.key === tabKey)) {
      activeTab.value = tabKey;
    }
  }
});

const activeTab = ref<string|LocationQueryValue[]|undefined>(props.tabs[0].key);

const switchTab = (key: string) => {
  route.query.tab = key
  activeTab.value = key;
};
</script>
