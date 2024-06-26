import { defineStore } from "pinia";
import type { User } from "~/types/user";

export const useFollowingStore = defineStore(
  "following",
  () => {
    const { $api } = useNuxtApp();

    const users = ref<User[]>([]);

    const getFollowingSuggestions = async () => {
      const { following }: { following: User[] } = await $api.get(
        "/user/suggestions"
      );

      users.value = following;
    };

    const spliceUser = (index: number) => {
      users.value.splice(index, 1);
    };

    return {
      users,
      spliceUser,
      getFollowingSuggestions,
    };
  },
  {
    persist: true,
  }
);
