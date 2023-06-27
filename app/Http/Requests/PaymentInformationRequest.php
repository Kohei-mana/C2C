<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class PaymentInformationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules(): array
    {
        $currentDate = Carbon::now();
        $expirationDate = Carbon::create(
            $this->input('expiration_year'),
            $this->input('expiration_month'),
            1,
        )->endOfMonth();

        return [
            'card_number' => ['required', 'regex:/^[0-9]+$/', 'min:16', 'max:16'],
            'cvv' => ['required', 'regex:/^[0-9]+$/', 'min:3', 'max:3'],
            'cardholder_name' => ['required', 'regex:/^[a-zA-Z ]+$/', 'max:255'],
            'expiration_month' => ['required'],
            'expiration_year' => ['required', function ($attribute, $value, $fail) use ($currentDate, $expirationDate) {
                if ($expirationDate->lessThan($currentDate->endOfMonth())) {
                    $fail('有効期限が過ぎています。');
                }
            }],
        ];
    }


    public function attributes()
    {
        return [
            'card_number',
            'cvv',
            'cardholder_name',
            'expiration_month',
            'expiration_year'
        ];
    }
}
