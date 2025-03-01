<?php

namespace App\Http\Requests\Rayvarz\Product;

use App\Http\Requests\BaseFormRequest;

class CheckAmountOfEachProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'itemDataId' => 'required',
            'warehouseId' => 'required',
        ];
    }
}