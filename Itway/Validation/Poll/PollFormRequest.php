<?php

namespace Itway\Validation\Poll;

use itway\Http\Requests\Request;
use Auth;
use Input;
use Toastr;

class PollFormRequest extends Request
{
    protected $rules = [
        'name' => 'required|min:3|max:120',
        'hint' => 'min:100|max:300',
        'options' => 'required|array|min:2|max:10',
        'image' =>'image_size:>=450,>=250|mimes:jpeg,jpg,png,bmp,gif,svg',
        'tags_list' => 'required|array|min:1|max:10',
        'published_at' => 'required|date'
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

            Toastr::warning("please login to create poll", $title = "Don't have a permission ", $options = []);

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
