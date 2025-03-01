<?php

namespace App\Http\Requests\RequestDetail;

use App\Http\Requests\BaseFormRequest;

class SetWarehouseDeliveryIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => 'required',
            'warehouse_delivery_id' => 'required',
        ];
    }
}
