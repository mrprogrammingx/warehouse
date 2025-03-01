<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseFormRequest;


class ProcessOfSetReturnDeliveryIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requestDetail.*.id' => 'required',
            'returnDeliveryId' => 'required',
            'requestId' => 'required',
        ];
    }
}
