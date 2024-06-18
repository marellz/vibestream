<template>
  <x-wrap>
    <div class="mx-auto lg:w-2/3 xl:w-1/2">
      <x-title>User profile</x-title>
      <x-content v-if="profile">
        <x-flex class="space-x-10">
          <div class="py-3">
            <user-avatar
              size="h-32 w-32 bg-gray-50 rounded-full"
              :avatar="profile?.avatar"
            />
          </div>
          <div class="space-y-2">
            <h1 class="text-4xl font-medium">
              {{ profile.name }}
            </h1>

            <x-flex
              v-for="item in availableContactDetails"
              :key="item"
              items-center
              class="space-x-2"
            >
              <component
                :is="contactDetailIcons[item as keyof ContactDetailIcons]"
                class="h-5"
              />
              <p>{{ profile[item as keyof UserProfile] }}</p>
            </x-flex>
            <div class="space-x-2 !my-4" v-if="!profile.is_me">
              <x-button v-if="profile.is_following" @click="unfollowUser">
                <span>Unfollow</span>
                <UserPlusIcon class="h-5" />
              </x-button>
              <x-button v-else @click="followUser">
                <span>Follow</span>
                <UserPlusIcon class="h-5" />
              </x-button>
            </div>
          </div>
        </x-flex>
        <hr />
        <div class="py-3">
          <div class="p-4 rounded-lg bg-gray-50">
            <h1 class="font-medium mb-2">Bio:</h1>
            <p>
              {{ profile.bio }}
            </p>
          </div>
        </div>
      </x-content>
      <x-content v-if="pending">
        <h1>Loading content</h1>
      </x-content>
      <x-content v-if="error" class="space-y-5">
        <h1>
          For some reason, or error, you can't view this user's profile because
          it was not properly loaded.
        </h1>
        <nuxt-link to="/" class="inline-block">
          <x-button>
            <FaceFrownIcon class="h-5" />
            <span>Go home</span>
          </x-button>
        </nuxt-link>
      </x-content>
    </div>
  </x-wrap>
</template>
<script lang="ts" setup>
import type { UserProfile } from "~/types/user";
import { useUserStore } from "~/store/user";
import {
  AtSymbolIcon,
  EnvelopeIcon,
  FaceFrownIcon,
  PhoneIcon,
  UserPlusIcon,
} from "@heroicons/vue/24/outline";
import { MapPinIcon } from "@heroicons/vue/24/solid";
import type { FunctionalComponent } from "vue";
const store = useUserStore();
const route = useRoute();

const username = route.params.username

const { data, error, pending, refresh } = await useAsyncData(`profile:${username}`, () =>
store.getUserProfile(username)
);

const profile= computed(()=> data.value)
const id = computed(()=> profile.value?.id ?? null)

interface ContactDetailIcons {
  phone_number: FunctionalComponent;
  username: FunctionalComponent;
  email: FunctionalComponent;
  location: FunctionalComponent;
}

const contactDetails = ref<string[]>([
  "username",
  "phone_number",
  "email",
  "location",
]);

const contactDetailIcons = ref<ContactDetailIcons>({
  phone_number: PhoneIcon,
  username: AtSymbolIcon,
  email: EnvelopeIcon,
  location: MapPinIcon,
});

const availableContactDetails = computed(() => {
  if (data.value) {
    return contactDetails.value.filter(
      (c) => data.value ? data.value[c as keyof UserProfile] !== null : false
    );
  }
  return [];
});


const unfollowUser = async () => {
  if(await store.unfollow(username)){
    refresh()
  }
}

const followUser = async () => {
  if(id.value){
    const success = await store.follow(username)
    if(success){
      refresh()
    }
  } 
}

onMounted(refresh);
</script>
