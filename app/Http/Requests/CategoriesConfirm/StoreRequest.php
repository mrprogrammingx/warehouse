<?php

namespace App\Http\Requests\CategoriesConfirm;

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
            'confirm_id' => 'required',
            'category_id' => 'required'
        ];
    }
}
