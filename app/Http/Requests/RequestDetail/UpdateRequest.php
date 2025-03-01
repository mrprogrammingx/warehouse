<?php

namespace App\Http\Requests\RequestDetail;

use App\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
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
}
