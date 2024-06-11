export interface User{
    id: number;
    name: string,
    email: string,
    avatar?: string | undefined,
}

export interface NewPasswordForm {
  old_password?: string;
  new_password?: string;
  new_password_confirmation?: string;
}

export interface UserBasicForm extends User {
}