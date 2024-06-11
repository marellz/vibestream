import type { User } from "~/types/user";
export default defineNuxtPlugin({
  dependsOn: ["api"],
  async setup() {
    const { $api } = useNuxtApp();

    console.log('initializing application');
    
  },
});
