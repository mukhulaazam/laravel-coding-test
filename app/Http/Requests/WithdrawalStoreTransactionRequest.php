<?php

namespace App\Http\Requests;

use App\Rules\IsSufficientBalance;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawalStoreTransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Withdrawal Amount is required',
            'amount.numeric' => 'Withdrawal Amount must be numeric',
            'amount.min' => 'Withdrawal Amount must be greater than 0',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'amount' => 'Withdrawal Amount',
        ];
    }
}
