<?php

namespace App\Http\Requests\Delivery;

use App\Http\Requests\BaseFormRequest;

class UpdateOnlineStatusRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => '',
            'online' => 'required',
        ];
    }
}
