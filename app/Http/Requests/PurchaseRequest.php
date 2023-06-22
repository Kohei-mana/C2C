<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'postal_code' => ['string', 'min:8', 'max:8'],
            'address' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'card_number' => ['required', 'string', 'min:16', 'max:16'],
            'cvv' => ['required', 'string', 'min:3', 'max:3'],
            'cardholder_name' => ['string', 'nullable', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'postal_code',
            'address',
            'name',
            'card_number',
            'expiration_month',
            'expiration_year',
            'cvv',
            'cardholder_name',
            'cart',
            'sum_price',
            'sum_quantity',
            'product_id',
            'quantity',
            'price'
        ];
    }
}
