<?php

namespace App\Http\Requests\Delivery;

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
            'user_id' => 'required',
            'vehicle_id' => 'required',
            'active' => '',
            'online' => '',
        ];
    }
}
