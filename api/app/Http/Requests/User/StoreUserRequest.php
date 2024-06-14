<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'string|required',
            'email' => 'string|required|email',
            'username' => ['string', 'required', 'unique:users'],
            'password' => 'string|min:8|max:24|confirmed|hashed',
            'gender' => 'nullable|string|sometimes',
            'phone_number' => 'nullable|string|sometimes',
            'avatar' => 'nullable|string|sometimes',
            'bio' => 'nullable|string|sometimes',
        ];
    }

    protected function prepareForValidation()
    {
       //
    }
}
