<?php

namespace App\Http\Requests\RequestDetail;

use App\Http\Requests\BaseFormRequest;

class SetDeliveredRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requestDetailId' => 'required'
        ];
    }
}
