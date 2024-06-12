<template>
  <x-flex column>
    <label :for="id">
      {{ label }}
    </label>
    <textarea
      :id="id"
      class="p-3 border rounded-lg w-full"
      :class="{ 'border-red-500': error }"
      :disabled
      :required
      :placeholder
      :rows
      :name
      :autoresize
      ref="textarea"
      :style="{height}"
      v-model="content"
    ></textarea>

    <!-- <form-error v-if="error">
      {{ error }}
    </form-error> -->
  </x-flex>
</template>
<script lang="ts" setup>
const props = withDefaults(
  defineProps<{
    label?: string;
    name?: string;
    disabled?: boolean;
    required?: boolean;
    error?: string;
    rows?: string | number;
    placeholder?: string;
    autoresize?: boolean;
    modelValue?: string;
  }>(),
  {
    type: "text",
    autocomplete: "off",
    required: false,
    disabled: false,
    rows: 3,
    autoresize: false,
  }
);

const id = useId();
const textarea = ref()
const content = defineModel<
  string | number | readonly string[] | null | undefined
>();

onMounted(() => {
  if (props.modelValue) {
    content.value = props.modelValue;
  }
});

const height = ref<string|number>("auto");

watch(
  () => content.value,
  (v2) => {
    if(v2==='' || v2===null){
      height.value = 'auto'
    } else {
      if(textarea.value){
        height.value = `${textarea.value?.scrollHeight + 2}px`
      }
    }
  }
);
</script>
