<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

class GetAllRecordsOfProductByIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}
