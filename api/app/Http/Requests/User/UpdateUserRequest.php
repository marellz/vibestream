<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::id() === $this->id;
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
            'id' => 'int|required',
            'username' => ['string','required','unique', Rule::unique('username')->ignore($this->user)],
            'name' => 'string|required',
            'email' => 'email|required',
            'password' => 'hashed|sometimes',
            'gender' => 'sometimes|string',
            'phone_number' => 'sometimes|string',
            'bio' => 'sometimes|string',
        ];
    }
}
