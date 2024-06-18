import { defineStore } from "pinia";
export const useGlobalStore = defineStore("global", () => {
  const { $api } = useNuxtApp();
  const version = ref<string|null>(null);
  const getVersion = async () => {
    const response : { version: string} = await $api.get("http://localhost:8000/api/status");
    version.value = response.version
  };

  return {
    version, getVersion
  }
});
