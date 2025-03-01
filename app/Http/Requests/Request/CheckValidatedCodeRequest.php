<?php

namespace App\Http\Requests\Request;

use App\Http\Requests\BaseFormRequest;

class CheckValidatedCodeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requestId' => 'int|required',
            'validatedCode' => 'int|required',
        ];
    }
}
