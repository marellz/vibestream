import type { User } from "./user";

export interface Comment {
  id: number;
  content: string;
  post_id: number;
  created: string;
  user: User
}