<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
            // return Auth::id() === $this->id;
        return Auth::check();
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
            'id' => 'int|sometimes',
            'username' => ['string','sometimes', Rule::unique('users')->ignore($this->id)],
            'name' => 'string|sometimes',
            'email' => 'email|sometimes',
            'gender' => 'sometimes|string|nullable',
            'phone_number' => 'sometimes|string|nullable',
            'bio' => 'sometimes|string|nullable',
        ];
    }
}
