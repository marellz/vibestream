import { defineStore } from "pinia";
import type { Post } from "~/types/post";

export type FeedType = "popular" | "default" | "latest" | "default";

export const useFeedStore = defineStore(
  "feeds",
  () => {
    const { $api } = useNuxtApp();
    const posts = ref<Post[] | []>([]);
    const pagination = ref<{
      page: number;
      perPage: number;
    }>({
      page: 1,
      perPage: 10,
    });

    const feedType = ref<FeedType>('default');
    watch(
      () => feedType.value,
      () => {
        getPosts();
      }
    );

    const getPosts = async () => {
      const { posts: _posts }: { posts: Post[] } = await $api.get(
        `/feed/${feedType.value}`
      );
      posts.value = _posts;

      return _posts
    };

    const updateFeed = (_feed: FeedType) => {
      feedType.value = _feed;
    };

    return {
      posts,
      getPosts,
      pagination,
      updateFeed,
    };
  },
  {
    persist: true,
  }
);
