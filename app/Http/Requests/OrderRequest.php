<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

            $rules = [ 'sku' => 'required|max:255',
                        'productcode' => 'required|max:255',
                        'model' => 'required|max:255',
                        'quantity' => 'required|max:255',
                        'uom' => 'required|max:255',
                        'itemdescription' => 'required|max:255',
                        'serialnumber' => 'required|max:255',



        ];
           /* foreach($this->request->get('addmore') as $key => $val) {
              $rules['addmore.'.$key] = 'required|max:10';
            }
            return $rules;*/

    }
}
