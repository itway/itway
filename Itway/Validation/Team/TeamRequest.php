<?php

namespace Itway\Validation\Team;

use itway\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use nilsenj\Toastr\Facades\Toastr;

class TeamRequest extends Request
{


    protected $rules = [
        'name' => 'required|min:3|max:120',
        'logo_bg' =>'image_size:>=450,>=250|mimes:jpeg,jpg,png,bmp,gif,svg',
        'tags_list' => 'required|array|min:1|max:8',
        'trend' => 'required|array|min:1|max:2',
        'country' => 'required|min:2|max:3'
        ];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()

    {
        if ( ! Auth::check() )
        {
            Toastr::warning("please login to create team", $title = "Don't have a permission ", $options = []);

            return redirect('/auth/login');
        }

        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return $this->rules;

    }
}
