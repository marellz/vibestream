<template>
  <div>
    <h1>Hello</h1>
    <p>App version is : {{  version ?? '--' }}</p>
    <button @click="request">request</button>
  </div>
</template>
<script lang="ts" setup>

const version = ref(null)

const request = async () => {
  try {
    await $fetch('http://localhost:8000/api',{
      headers:{
        'Accept' : 'application/json',
        'Content-Type' : 'application/json'
      }
    })
  } catch (error) {
    console.log({error});
    
  }
}

</script>
<style scoped>
div{
  height: 30vh;
  padding-top: 100px;
  text-align: center;
}
</style>