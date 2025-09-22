<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|string|min:6|max:100',
            'name' => 'required|string|max:75',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.max' => 'The email field must not exceed 50 characters.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be at least 6 characters.',
            'password.max' => 'The password field must not exceed 100 characters.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must contain valid characters.',
            'name.max' => 'The name field must not exceed 75 characters.',
        ];
    }
}
