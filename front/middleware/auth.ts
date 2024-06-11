import { useAuthStore } from "~/store/auth";

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  if (!authStore.authenticated) {
    return navigateTo("/auth/login");
  } else {
    return;
  }
});
