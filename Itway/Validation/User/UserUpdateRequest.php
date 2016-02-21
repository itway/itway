<?php

namespace Itway\Validation\User;

use itway\Http\Requests\Request;
use Auth;

class UserUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::guest() && Auth::user()->id == $this->id)
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
            'name' => 'min:3|max:32',
            'email' => 'email|min:3|max:32',
            'bio' => 'min:120|max:1000',
            'password' => 'string|min:8|max:32',
            'location' => 'string|min:3|max:64',
            'country' => 'string|min:2|max:3',
            'Google' => "email|unique:users,Google, ".Auth::user()->id."|max:255",
            'Facebook' => "url|unique:users,Facebook, ".Auth::user()->id."|max:255",
            'Github' => "url|unique:users,Github, ".Auth::user()->id."|max:255",
            'Twitter' => "string|unique:users,Twitter, ".Auth::user()->id."|min:3|max:255",
        ];
    }
}
