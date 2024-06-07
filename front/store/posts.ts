import { defineStore, acceptHMRUpdate } from "pinia";
import type { Post } from "~/types/post";

interface NewComment {
  post_id: number;
  content: string;
}

interface NewPost {
  content: string;
}

interface LikePayload {
  post_id: number;
  liked: boolean;
}

export const usePostsStore = defineStore("posts", () => {
  const { $api } = useNuxtApp();
  const posts = ref<Post[]>([]);
  const getPosts = async () => {
    const { items }: { items: Post[] } = await $api.get("/posts");
    posts.value = items;
    
  };

  const createPost = async (payload: NewPost) => {
    const { item }: { item: Post } = await $api.post("/posts", payload);
    //prepend post
    posts.value.unshift(item);

    return true;
  };

  const createComment = async (payload: NewComment) => {
    const { item }: { item: Comment } = await $api.post("/comments", payload);
    //prepend comment
    let post = posts.value.find((p) => p.id === payload.post_id);

    post?.comments.unshift(item);

    return true;
  };

  const likePost = async (payload: LikePayload) => {
    try {
      let { liked, likes }: { liked: boolean; likes: number } = await $api.post(
        "/likes",
         payload 
      );
      let post = posts.value.findIndex((p) => p.id === payload.post_id);
      if (post !== -1) {
        posts.value[0].likes = likes
        posts.value[0].liked = liked
      }
      
    } catch (error) {
      console.error(error);
      
    }
  };

  return {
    posts,
    getPosts,
    createPost,
    createComment,
    likePost,
  };
});

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(usePostsStore, import.meta.hot));
}