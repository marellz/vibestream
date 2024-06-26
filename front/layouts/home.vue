<template>
  <div ref="wrapper" id="wrapper" class="flex flex-col h-[100vh]">
    <layouts-header />
    <main class="flex-auto">
        <slot />
    </main>
    <layouts-footer />
  </div>
</template>
