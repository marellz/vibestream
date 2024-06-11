import type { AxiosError } from "axios";
import { defineStore, acceptHMRUpdate } from "pinia";
import type { RegistrationPayload } from "~/types/auth";
import type { NewPasswordForm, User } from "~/types/user";
import { useAuthStore } from "./auth";

export const useUserStore = defineStore(
  "user",
  () => {
    const { $api } = useNuxtApp();
    const auth = useAuthStore()
    const router = useRouter()

    const user = ref<User | null>();

    const setUser = (_user: User | null) => {
      user.value = _user;
    };

    const register = async (payload: RegistrationPayload) => {};

    const updatePassword = async (payload: NewPasswordForm) => {
      try {
        const {
          message,
          updated,
        }: { updated: boolean; message: string; errors: {} } = await $api.patch(
          "/user/password",
          payload
        );
        return { message, success: updated };
      } catch ({ message }: any) {
        return { success: false, message };
      }
    };

    const getUser = async () => {
      try {
        const { user: _user }: { user: User } = await $api.get("/user");
        if(_user){
          setUser(_user);
          return _user;
        }
      } catch (error: any) {
        if (error.message === "Unauthenticated.") {
          await auth.logout();
          await router.push("/auth/login");
        }
      }
    };

    const updateUser = async (payload: User) => {
      const { updated }: { updated: boolean } = await $api.patch(
        "/user",
        payload
      );

      if (updated) {
        user.value = await getUser();
      }

      return updated;
    };

    const updateAvatar = async (payload: FormData) => {
      const { updated }: { updated: boolean; avatar: string } = await $api.post(
        "/user/avatar",
        payload,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );

      if (updated && user.value) {
        getUser();
      }

      return updated;
    };

    const deleteAvatar = async () => {
      const { deleted }: { deleted: string } = await $api.delete(
        "/user/avatar"
      );

      return deleted
    };

    const deleteUser = () => {
      setUser(null);
    };

    const firstName = computed(() => user.value?.name.split(" ")[0]);

    return {
      user,
      firstName,
      getUser,
      register,
      updateUser,
      setUser,
      updatePassword,
      updateAvatar,
      deleteUser,
      deleteAvatar,
    };
  },
  { persist: true }
);

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useUserStore, import.meta.hot));
}
