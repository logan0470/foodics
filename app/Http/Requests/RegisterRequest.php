<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterRequest extends \Illuminate\Foundation\Http\FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }


    public function rules()
    {
        return ['customer_name' => 'required', 'customer_phone' => 'required',
            'address' => 'required', 'products' => 'required'];
    }

}
