<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseFormRequest;

class GetAllForWarehouseDeliveryIdIsNotArchiveAndCancelRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'warehouseDeliveryId' => 'required',
        ];
    }
}
