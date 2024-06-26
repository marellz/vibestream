<template>
  <x-flex column>
    <label v-if="label" :for="id">
      {{ label }}
    </label>

    <div class="flex relative">
      <input
        class="p-3 border rounded-lg w-full"
        :class="{'border-red-500':error}"
        :type="btnType"
        :id="id"
        :name="name"
        :disabled="disabled"
        :required="required"
        :placeholder="placeholder"
        autocomplete="autocomplete"
        v-model="model"
      />

      <button
        v-if="type === 'password'"
        type="button"
        class="absolute right-4 top-1/2 transform -translate-y-1/2"
        @click="togglePassword"
        :class="{ 'opacity-30': !toggled }"
      >
        <EyeIcon class="h-5" />
      </button>
    </div>

    <form-error v-if="error">
      {{ error }}
    </form-error>
  </x-flex>
</template>
<script lang="ts" setup>
import { EyeIcon } from "@heroicons/vue/24/solid";
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
const toggled = ref<boolean>(false);
const btnType = ref<string>(props.type);

const togglePassword = () => {
  toggled.value = !toggled.value;
  btnType.value = btnType.value === props.type ? "text" : props.type;
};

onMounted(() => {
  if (props.modelValue) {
    model.value = props.modelValue;
  }
});
</script>
