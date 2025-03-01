<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOrStoreByPersonnelCodeRequest extends FormRequest
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
            'data' => ''
            // 'data.*.first_name' => '',
            // 'data.*.last_name' => '',
            // 'data.*.mobile' => '',
            // 'data.*.user_name' => '',
            // 'data.*.personnel_code' => 'required|size:4',
            // 'data.*.password' => 'required',
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
