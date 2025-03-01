<?php

namespace App\Http\Requests\CategoriesConfirm;

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
            'id' => 'required',
            'confirm_id' => '',
            'category_id' => ''
        ];
    }
}
