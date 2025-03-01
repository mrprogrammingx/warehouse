<?php

namespace App\Http\Requests\RequestDetail;

use App\Http\Requests\BaseFormRequest;

class UpdateDeliveryIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.request_id' => 'required',
            '*.delivery_id' => 'required',
        ];
    }
}
