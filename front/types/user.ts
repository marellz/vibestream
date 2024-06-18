export interface User{
    id: number;
    name: string,
    username: string,
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
  
  export interface UserProfile extends User{
    is_me?: boolean;
    is_followed_by?: boolean;
    is_following?: boolean;

}