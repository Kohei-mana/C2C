<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentInformationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_number' => ['required', 'string', 'min:16', 'max:16'],
            'cvv' => ['required', 'string', 'min:3', 'max:3'],
            'cardholder_name' => ['string', 'nullable', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'card_number',
            'cvv',
            'cardholder_name'
        ];
    }
}
