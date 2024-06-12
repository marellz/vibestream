export interface User{
    id: number;
    name: string,
    email: string,
    avatar?: string | undefined,
    bio?: string;
    gender?: string,
    phone_number?: string,
}

export interface NewPasswordForm {
  old_password?: string;
  new_password?: string;
  new_password_confirmation?: string;
}

export interface UserBasicForm extends User {
}