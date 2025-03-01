<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

class ProductsByWarehouseIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'warehouseId' => 'required'
        ];
    }
}
