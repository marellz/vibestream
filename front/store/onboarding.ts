import { defineStore } from "pinia";
import { useAuthStore } from "./auth";
import { useUserStore } from "./user";
import type { User, UserRegistration } from "~/types/user";

interface RegistrationResponse {
  success: boolean;
  user?: User;
  authorisation: {
    token: string;
    type: string;
  };
}

export const useOnboardingStore = defineStore("onboarding", () => {
  const { $api } = useNuxtApp();

  const auth = useAuthStore();
  const userStore = useUserStore();

  const genders = [
    {
      label: "Male",
      value: "male",
    },
    {
      label: "Female",
      value: "female",
    },
    {
      label: "Other",
      value: "other",
    },
    {
      label: "Prefer not to say",
      value: "undisclosed",
    },
  ];

  const interests = computed(() => {
    return [
      "Technology",
      "Health",
      "Travel",
      "Education",
      "Business",
      "Entertainment",
      "Sports",
      "Science",
      "Politics",
      "Environment",
      "Fashion",
      "Food",
      "Music",
      "Art",
      "History",
    ].map((label) => ({
      value: label.replaceAll(" ", "-").toLowerCase(),
      label,
    }));
  });

  const register = async (payload: UserRegistration) => {
    const { success, authorisation }: RegistrationResponse = await $api.post(
      "/auth/register",
      payload
    );

    if (success) {
      auth.setToken(authorisation.token);
      auth.token = authorisation.token;
      userStore.getUser();
    }

    return success;
  };

  return {
    register,
    genders,
    interests,
  };
});
