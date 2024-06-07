import type { User } from "./user";

export interface LoginResponse {
  user: User;
  status: string;
  authorisation: {
    token: string;
  };
}

export interface RegistrationPayload {
  email: string;
  name: string;
  password: string;
  password_confirmed: string;
}

export interface LoginPayload {
  email: string;
  password: string;
}
