import { defineStore, acceptHMRUpdate } from "pinia";
import type { User } from "~/types/user";
import type { LoginPayload, LoginResponse, RegistrationPayload } from "~/types/auth";

export const useAuthStore = defineStore("auth", 
() => {
  const { $api } = useNuxtApp();
  const user = ref<User | null>();
  const token = ref<string|null>(null)
  const authenticated = computed(() => !!user.value);
  const firstName = computed(()=> user.value?.name.split(' ')[0])

  const setToken = (token: string| null) => {
    $api.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${token}`;
  }

  onBeforeMount(()=> {
    if(token.value){
      setToken(token.value)
    }
  })

  const register = async (payload: RegistrationPayload) => {}

  const login = async (payload: LoginPayload) => {
    const response: LoginResponse = await $api.post("/auth/login", payload);
    const { user: _user, status, authorisation } = response;

    if (status !== "success") {
      // handle error
      return false;
    }
    // set token to $api
    setToken(authorisation.token)
    user.value = _user;
    token.value = authorisation.token

    return true
  };

  const logout = async () => {
    const { status } : { status: string; } = await $api.post("/auth/logout");

    if (status !== "success") {
      // handle error
      return false;
    }

    // remove token
    setToken(null)
    user.value = null;
    token.value = null
  };

  return {
    authenticated,
    user,
    token,
    firstName,
    login,
    logout,
  };
}, { persist: true});

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useAuthStore, import.meta.hot));
}