<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'string|min:8|max:24|confirmed|hashed',
            'gender' => 'sometimes|string',
            'phone_number' => 'sometimes|string',
            'avatar' => 'sometimes|string',
            'bio' => 'sometimes|string',
        ];
    }

    protected function prepareForValidation()
    {
       //
    }
}
