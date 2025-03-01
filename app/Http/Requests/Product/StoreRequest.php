<?php

namespace App\Http\Requests\Product;

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
            'name' =>'required',
            'Attributes' =>'',
            'worn' =>'required',
            'descriptions' =>'',
            'file_id' =>'',
            'category_id' =>'',
            'rayvarz_id' =>'',
            'technical_index_id' =>''
        ];
    }

}