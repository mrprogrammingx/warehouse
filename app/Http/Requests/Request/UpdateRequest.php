<?php

namespace App\Http\Requests\Request;

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
            'user_id' => 'required',
            'status_id' => '',
            'unit_id' => 'required',
            'descriptions' => '',
        ];
    }
}
