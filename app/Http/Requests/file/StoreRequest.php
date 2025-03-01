<?php

namespace App\Http\Requests\file;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreRequest extends FormRequest
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
            'filesCategory_id' => '',
            'name' => 'required',
            'url' => '',
            'user_id' => '',
            'file' => 'file|max:2048',
            'route' => '',
            'description' => 'required',
        ];
    }

    public function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json([ 
            'success'   => false, 
            'message'   => $validator->errors(), 
            'data'      => $validator->errors() 
        ],400)); 
    }
}
