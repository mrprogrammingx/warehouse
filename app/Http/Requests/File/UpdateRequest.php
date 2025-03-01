<?php

namespace App\Http\Requests\File;

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
            'category_id' => '',
            'name' => '',
            'url' => '',
            'file' => ''
        ];
    }
}
