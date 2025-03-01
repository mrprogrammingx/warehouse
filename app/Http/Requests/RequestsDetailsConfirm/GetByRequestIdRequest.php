<?php

namespace App\Http\Requests\RequestsDetailsConfirm;

use App\Http\Requests\BaseFormRequest;

class GetByRequestIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => 'required'
        ];
    }
}
