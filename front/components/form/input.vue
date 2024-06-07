<template>
  <x-flex column>
    <label v-if="label" :for="id">
      {{ label }}
    </label>
    <input
      class="p-3 border rounded-lg"
      :type="type"
      :id="id"
      :name="name"
      :disabled="disabled"
      :required="required"
      :placeholder="placeholder"
      autocomplete="autocomplete"
      v-model="model"
    />

    <!-- <form-error v-if="error">
      {{ error }}
    </form-error> -->
  </x-flex>
</template>
<script lang="ts" setup>
import { onMounted } from "vue";
const props = withDefaults(
  defineProps<{
    label?: string;
    type?: string;
    name?: string;
    autocomplete?: string;
    disabled?: boolean;
    required?: boolean;
    error?: string;
    placeholder?: string;
    modelValue?: string;
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
