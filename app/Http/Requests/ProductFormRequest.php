<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'integer'
            ],

            'location' => [
                'required',
                'string'
            ],



            'brand' => [
                'required',
                'string',
                'max:255'
            ],

            'model' => [
                'required',
                'string'
            ],

            'sku' => [
                'required',
                'string'
            ],
            'productcode' => [
                'required',
                'string'
            ],
            'uom' => [
                'required',
                'string'
            ],

            'description' => [
                'required',
                'string'
            ],


            'quantity' => [
                'required',
                'integer'
            ],

        ];
    }
}
