<?php


namespace Itway\Validation\User;

use itway\Http\Requests\Request;
use Auth;

class UserPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|image_size:>=150,>=150|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];
    }
}
