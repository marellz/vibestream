import { defineStore, acceptHMRUpdate } from "pinia";
import type { LoginPayload, LoginResponse } from "~/types/auth";
import { useUserStore } from "./user";

export const useAuthStore = defineStore(
  "auth",
  () => {
    const { $api } = useNuxtApp();
    const userStore = useUserStore();

    const token = ref<string | null>(null);
    const authenticated = computed(() => token.value !== null);

    const setToken = (token: string | null) => {
      $api.defaults.headers.common["Authorization"] = `bearer ${token}`;
    };

    const login = async (payload: LoginPayload) => {
      const response: LoginResponse = await $api.post("/auth/login", payload);
      const { user: _user, status, authorisation } = response;

      if (status !== "success") {
        // handle error
        return false;
      }
      // set token to $api
      setToken(authorisation.token);
      // userStore.setUser(_user);

      userStore.getUser();
      token.value = authorisation.token;

      return true;
    };

    const logout = async () => {
      try {
        await $api.post("/auth/logout");
      } catch (error) {
      } finally {
        // remove token
        setToken(null);
        userStore.deleteUser();
        token.value = null;
      }
    };

    const check = async () => {
      const { authenticated: _auth }: { authenticated: boolean } =
        await $api.get("/auth/check");
      if (!_auth && token.value) {
        logout();
      }
    };

    onBeforeMount(() => {
      if (token.value) {
        setToken(token.value);
      }
      check();
    });

    watch(
      () => authenticated.value,
      (auth) => {
        const route = useRoute()
        const router = useRouter()
        if(!auth && route.meta.middleware === 'auth'){
          router.push('/')
        }
      }
    );

    return {
      authenticated,
      token,
      login,
      logout,
      check,
    };
  },
  { persist: true }
);

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useAuthStore, import.meta.hot));
}
