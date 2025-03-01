<?php

namespace App\Http\Requests\RequestsDetailsConfirm;

use App\Http\Requests\BaseFormRequest;

class UpdateByRequestDetailUserConfirmIdRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.requests_detail_confirm_id' => 'required',
            '*.requests_detail_id' => 'required',
            '*.confirm_id' => 'required',
            '*.user_id' => '',
            '*.confirmed' => 'required',
            '*.description' => '',
        ];
    }
}
