<?php

namespace App\Http\Requests\RequestsDetailsConfirm;

use App\Http\Requests\BaseFormRequest;

class GetByRequestsDetailIdRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requests_detail_id' => 'required'
        ];
    }
}
