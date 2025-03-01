<?php

namespace App\Http\Requests\requestDetail;

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
            'requestDetails.*.id' => 'required',
            'requestDetails.*.request_id' => '',
            'requestDetails.*.product_id' => '',
            'requestDetails.*.status_id' => '',
            'requestDetails.*.delivery_id' => '',
            'requestDetails.*.warehouses_id' => '',
            'requestDetails.*.warehouse_delivery_id' => '',
            'requestDetails.*.amount' => '',
            'requestDetails.*.location' => '',
            'requestDetails.*.center_id' => '',
            'requestDetails.*.worn' => '',
            'requestDetails.*.worn_amount' => '',
            'requestDetails.*.delivered' => '',
            'requestDetails.*.has_remittance' => '',
            'requestDetails.*.descriptions' => ''
        ];
    }

    public function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json([ 
            'success'   => false, 
            'message'   => 'Validation errors', 
            'data'      => $validator->errors() 
        ],400)); 
    }
}
