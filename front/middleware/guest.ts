import { useAuthStore } from "~/store/auth";

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  if (authStore.authenticated || authStore.token) {
    return navigateTo("/");
  } else {
    return;
  }
});
