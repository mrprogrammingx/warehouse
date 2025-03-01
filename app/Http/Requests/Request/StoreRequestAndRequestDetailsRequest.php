<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseFormRequest;


class StoreRequestAndRequestDetailsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request.user_id' => '',
            'request.status_id' => '',
            'request.unit_id' => '',
            'request.confirmed' => '',
            'request.descriptions' => '',
            'request.warehouses_id' => 'required',
            'request.date' => '',
            'requestDetails.*.product_id' => 'required',
            'requestDetails.*.status_id' => '',
            'requestDetails.*.file_id' => '',
            'requestDetails.*.delivery_id' => '',
            'requestDetails.*.amount' => 'required',
            'requestDetails.*.location' => '',
            'requestDetails.*.center_id' => '',
            'requestDetails.*.warehouses_id' => '',
            'requestDetails.*.warehouse_delivery_id',
            'requestDetails.*.item_consumption_type_id',
            'requestDetails.*.center3_id',
            'requestDetails.*.return_delivery_id',
            'requestDetails.*.return_user_id',
            'requestDetails.*.returned',
            'requestDetails.*.edited',
            'requestDetails.*.not_exist',
            'requestDetails.*.has_remittance',
            'requestDetails.*.worn' => '',
            'requestDetails.*.worn_amount' => '',
            'requestDetails.*.confirmed' => '',
            'requestDetails.*.descriptions' => '',
            'requestDetails.*.file' => '',
            'requestDetails.*.file_flag' => '',
            'requestDetails.*.name_file' => '',
        ];
    }
}
