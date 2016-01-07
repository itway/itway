<?php

namespace Itway\Validation\Event;

use itway\Http\Requests\Request;
use Auth;
use nilsenj\Toastr\Facades\Toastr;

class UpdateEventRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( ! Auth::check() )
        {
            Toastr::warning("please login to create event", $title = "Don't have a permission ", $options = []);

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
        return [
            'name' => 'required|string|min:3|max:120',
            'description' => 'required|string|min:3|max:8000',
            'preamble' => 'required|string|min:100|max:300',
            'time' => 'required|string|min:3|max:24',
            'date' => 'required|date',
            'timezone' => 'required|timezone',
            'event_format' => 'required|min:2|max:52',
            'image' =>'image_size:>=450,>=250|mimes:jpeg,jpg,png,bmp,gif,svg',
            'tags_list' => 'required|array|min:1|max:3',
            'youtube_link' => 'string|min:6|max:120',
            'city' => 'string|min:2|max:120',
            'invite' => 'string|min:5|max:120',
            'speakers' => 'string',
            'today' => 'date',
            'banned' => 'boolean'
        ];
    }
}
