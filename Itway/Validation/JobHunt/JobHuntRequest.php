<?php

namespace itway\Http\Requests\\..\..\..\Itway\Validation\JobHunt;

use itway\Http\Requests\Request;

class JobHuntRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
