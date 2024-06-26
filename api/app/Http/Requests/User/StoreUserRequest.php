<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'name' => 'string|required|max:255',
            'email' => 'string|required|email|max:255|unique:users',
            'username' => 'string|required|unique:users|max:255',
            'password' => 'string|min:8|max:24|confirmed',
            'gender' => 'nullable|string|sometimes',
            'phone_number' => 'nullable|string|sometimes',
            'avatar' => 'nullable|string|sometimes',
            'bio' => 'nullable|string|sometimes',
        ];
    }

    protected function prepareForValidation()
    {
        //
        $this->merge([
            'username' => Str::random(12),
        ]);
    }
}
