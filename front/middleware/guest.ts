import { useAuthStore } from "~/store/auth";

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  if (authStore.authenticated) {
    return navigateTo("/");
  } else {
    console.log("guest yeaa");
    return;
  }
});
