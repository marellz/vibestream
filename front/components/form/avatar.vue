<template>
  <div class="">
    <form @submit.prevent="updateAvatar">
      <input
        class="h-px w-px absolute"
        accept="image/*"
        name="avatar"
        type="file"
        :id="id"
        @change="onChange"
      />
      <label class="p-3 block border rounded-lg border-dashed" :for="id">
        <x-flex class="items-center space-x-2">
          <img
            v-if="avatar"
            :src="avatar"
            class="h-20 w-20 rounded-full object-cover"
          />
          <UserCircleIcon v-else class="h-20 text-gray-300" />
          <template v-if="file">
            <x-flex items-center class="space-x-2">
              <div>
                <p class="font-medium">{{ file.name }}</p>
                <x-flex items-center class="space-x-2 mt-2">
                  <button
                    type="button"
                    class="inline-flex items-center space-x-2 text-red-500"
                    @click.prevent="deleteFile"
                  >
                    <TrashIcon class="h-5" />
                    <span>Delete file</span>
                  </button>
                  <span class="border-l border-gray-200 h-10"></span>
                  <button
                    class="inline-flex items-center space-x-2 text-blue-500"
                  >
                    <CloudArrowUpIcon class="h-5" />
                    <p>Upload photo</p>
                  </button>
                </x-flex>
              </div>
            </x-flex>
          </template>
          <template v-else-if="avatar">
            <x-flex items-center class="space-x-2">
              <div>
                <button
                  type="button"
                  class="inline-flex items-center space-x-2 text-red-500"
                  @click.prevent="deleteAvatar"
                >
                  <TrashIcon class="h-5" />
                  <span>Delete avatar</span>
                </button>
              </div>
            </x-flex>
          </template>
          <template v-else>
            <div class="px-2">
              <p class="font-medium">Update avatar</p>
              <p class="text-sm text-gray-500">Select a file to upload</p>
            </div>
          </template>
        </x-flex>
      </label>
    </form>
  </div>
</template>
<script lang="ts" setup>
import { TrashIcon, CloudArrowUpIcon } from "@heroicons/vue/24/outline";
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { useUserStore } from "~/store/user";

const id = useId();
const file = ref<File | null>(null);
const store = useUserStore();
const emit = defineEmits(["get-user"]);
const avatar = computed(() => store.user?.avatar);
const onChange = (ev: Event) => {
  let _target = ev.target as HTMLInputElement;
  if (_target.files && _target.files.length) {
    file.value = _target.files[0];
    updateAvatar();
  }
};

const updateAvatar = async () => {
  let form = new FormData();
  if (file.value) {
    form.append("avatar", file.value, file.value.name);
    let updated: boolean = await store.updateAvatar(form);
    if (updated) {
      file.value = null;
    }
  }
};

const deleteAvatar = async () => {
  let deleted = await store.deleteAvatar();
  if (deleted) {
    store.getUser();
  }
};

const deleteFile = async () => {
  file.value = null;
};
</script>
