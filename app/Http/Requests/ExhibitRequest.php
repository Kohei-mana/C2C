<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExhibitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:40'],
            'category_id' => ['required'],
            'price' => ['required', 'integer', 'min:300', 'max:9999999'],
            'inventory' => ['required', 'integer', 'min:1'],
            'description' => ['string', 'nullable', 'max:1000'],
            'image' => ['sometimes', 'required']
        ];
    }

    public function attributes()
    {
        return [
            'product_name',
            'category_id',
            'category_name',
            'price',
            'inventory',
            'description',
            'image'

        ];
    }
}
