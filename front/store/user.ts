import { defineStore, acceptHMRUpdate } from "pinia";
import type { RegistrationPayload } from "~/types/auth";
import type { NewPasswordForm, User, UserProfile } from "~/types/user";
import { useAuthStore } from "./auth";

type RouteUsername = string | string[];

export const useUserStore = defineStore(
  "user",
  () => {
    const { $api } = useNuxtApp();
    const auth = useAuthStore();
    const router = useRouter();

    const user = ref<User | null>();
    const userProfile = ref<UserProfile | null>();

    const getMyProfile = async () => {
      const { profile }: { profile: UserProfile } = await $api.get(
        "/user/profile"
      );
      if (profile) {
        userProfile.value = profile;
      }
    };

    const getUserProfile = async (username: RouteUsername) => {
      const { profile }: { profile: UserProfile } = await $api.get(
        `/profile/${username}`
      );

      return profile;
    };

    const getFollowers = async (username: RouteUsername) => {
      const { followers: _users }: { followers: UserProfile[] } =
        await $api.get(`/profile/${username}/followers`);
      if (_users.length) {
        return _users;
      } else {
        return null;
      }
    };
    const getFollowing = async (username: RouteUsername) => {
      const { following: _users }: { following: UserProfile[] } =
        await $api.get(`/profile/${username}/following`);
      if (_users.length) {
        return _users;
      } else {
        return null;
      }
    };

    const getSuggestedFollowing = async (username: RouteUsername) => {
      return [];
    };

    const follow = async (username: RouteUsername) => {
      const { success }: { success: boolean } = await $api.post(
        `/follow/${username}`,
      );

      return success ?? false;
    };

    const unfollow = async (username: RouteUsername) => {
      const { success }: { success: boolean } = await $api.delete(
        `/follow/${username}`
      );

      return success ?? false;
    };

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
        if (_user) {
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

    const updateUser = async (payload: User | Partial<User>) => {
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

      return deleted;
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
      getFollowers,
      getFollowing,
      getSuggestedFollowing,
      getMyProfile,
      getUserProfile,
      follow,
      unfollow,
    };
  },
  { persist: true }
);

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useUserStore, import.meta.hot));
}
