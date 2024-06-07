import type { User } from "./user";

export interface Post {
  id: number;
  content: string;
  user: User;
  comments: Comment[];
  created: string;
  liked?: boolean;
  likes: number;
}
