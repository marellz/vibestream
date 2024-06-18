<template>
  <div>
    <h1 class="text-2xl lg:text-4xl font-bold">
      <slot />
    </h1>
    <slot name="after"/>
  </div>
</template>
<script lang="ts" setup></script>
