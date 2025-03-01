<?php

namespace App\Http\Requests\Request;

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
            'user_id' => '',
            'status_id' => '',
            'unit_id' => '',
            'descriptions' => '',
        ];
    }
}
