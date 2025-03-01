<?php

namespace App\Http\Requests\RequestsDetailsConfirm;

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
            'requests_detail_id' => '',
            'confirm_id' => '',
            'user_id' => '',
            'confirmed' => '',
            'description' => '',
        ];
    }
}
