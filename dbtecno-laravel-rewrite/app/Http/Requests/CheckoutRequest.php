<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'min:10', 'max:500'],
            'payment_method' => ['required', 'in:credit_card,bank_transfer,cash_on_delivery'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
