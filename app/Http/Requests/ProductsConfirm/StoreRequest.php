<?php

namespace App\Http\Requests\ProductsConfirm;

use App\Http\Requests\BaseFormRequest;


class StoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'confirm_id' => 'required',
        ];
    }
}