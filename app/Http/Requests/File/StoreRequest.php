<?php

namespace App\Http\Requests\File;

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
            'filesCategory_id' => '',
            'name' => 'required',
            'url' => '',
            'user_id' => '',
            'file' => 'file|max:2048',
            'route' => '',
            'description' => 'required',
        ];
    }
}
