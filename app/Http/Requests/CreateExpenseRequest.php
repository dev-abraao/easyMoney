<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExpenseRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'date' => ['required', 'date'],
            'expense_type_id' => ['required', 'exists:expense_types,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'description.required' => 'Please provide a description.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description may not be greater than 255 characters.',
            'amount.required' => 'Please provide an amount.',
            'amount.numeric' => 'Amount must be a number.',
            'amount.min' => 'Amount must be at least 0.01.',
            'date.required' => 'Please provide a date.',
            'date.date' => 'Invalid date format.',
            'expense_type_id.required' => 'Please select an expense type.',
            'expense_type_id.exists' => 'Selected expense type is invalid.',
        ];
    }
}
