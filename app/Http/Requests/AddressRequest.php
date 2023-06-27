<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'postal_code' => ['regex:/^[0-9]{3}-[0-9]{4}$/', 'min:8', 'max:8'],
            'address' => ['string', 'max:255'],
            'name' => ['string', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'postal_code',
            'address',
            'name'
        ];
    }
}
