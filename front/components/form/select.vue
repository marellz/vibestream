<template>
  <x-flex column>
    <label :for="id" class="">
      {{ label }}
    </label>
    <div class="flex relative">
      <select
        :id
        class="p-3 border rounded-lg w-full bg-transparent appearance-none"
        :class="{ 'border-red-500': error }"
        :disabled
        :required
        :name
        v-model="model"
        >
        <option v-if="placeholder" :value="null" disabled>{{ placeholder }}</option>
        <template v-if="options && options.length">
          <option
            v-for="(op, index) in options"
            :key="`${id}-${index}`"
            :value="op.value"
          >
            {{ op.label }}
          </option>
        </template>
        <slot />
      </select>
      <span class="absolute right-4 top-1/2 transform -translate-y-1/2">
        <ChevronDownIcon class="h-5" />
      </span>
    </div>
  </x-flex>
</template>
<script lang="ts" setup>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
const props = withDefaults(
  defineProps<{
    label?: string;
    name?: string;
    autocomplete?: string;
    disabled?: boolean;
    required?: boolean;
    error?: string;
    placeholder?: string;
    modelValue?: string;
    options?: { value: string; label: string }[];
  }>(),
  {
    type: "text",
    autocomplete: "off",
    required: false,
    disabled: false,
  }
);

const id = useId();
const model = defineModel();

onMounted(() => {
  if (props.modelValue) {
    model.value = props.modelValue;
  }
});
</script>
