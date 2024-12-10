<template>
  <div class="relative">
    <input
      class="h-0 w-0 absolute"
      :id
      :name
      type="checkbox"
      :value="inputValue"
      :disabled
      v-model="modelValue"
    />
    <label :for="id">
      <form-selectable :disabled :selected>
        <slot />
      </form-selectable>
    </label>
  </div>
</template>
<script lang="ts" setup>
import customId from '~/composables/useId';

const id = customId();
const props = withDefaults(
  defineProps<{
    inputValue: string | number;
    modelValue: Array<string | number>;
    disabled?: boolean;
    name?: string;
    max?: number;
  }>(),
  {}
);

const modelValue = defineModel();

const selected = computed<boolean>(() =>
  props.modelValue.includes(props.inputValue)
);
</script>
