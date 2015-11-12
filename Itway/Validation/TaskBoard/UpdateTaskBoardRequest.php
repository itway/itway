<?php

namespace itway\Http\Requests\\..\..\..\Itway\Validation\TaskBoard;

use itway\Http\Requests\Request;

class UpdateTaskBoardRequest extends Request
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
