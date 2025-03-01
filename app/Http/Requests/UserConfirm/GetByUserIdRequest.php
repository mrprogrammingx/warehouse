<?php

namespace App\Http\Requests\UserConfirm;

use App\Http\Requests\BaseFormRequest;

class GetByUserIdRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId' => ''
        ];
    }
}
