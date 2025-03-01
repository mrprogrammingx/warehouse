<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '‌id' => 'required',
            'first_name' => '',
            'last_name' => '',
            'mobile' => '',
            'user_name' => '',
            'personnel_code' => 'required|size:4',
            'password' => ''
        ];
    }

    public function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json([ 
            'success'   => false, 
            'message'   => $validator->errors() , 
            'data'      => $validator->errors() 
        ],400)); 
    }
}
