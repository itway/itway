<?php

namespace Itway\Validation\Event;

use itway\Http\Requests\Request;
use Auth;
use nilsenj\Toastr\Facades\Toastr;

class EventRequest extends Request
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
            'description' => 'required|string|min:3|max:5000',
            'preamble' => 'required|string|min:120|max:300',
            'time' => 'required|string|min:3|max:24', 
            'date' => 'required|string', 
            'organizer' => 'string|min:3|max:120',
            'organizer_link' => 'url',
            'address' => 'string|min:3|max:120',
            'max_people_number' => 'numeric|min:3',
            'timezone' => 'timezone',
            'city' => 'min:2|max:52',
            'country' => 'min:2|max:3',
            'event_format' => 'min:2|max:52',
            'event_invite' => 'url',
            'event_photo' => 'image_size:>=450,>=250|mimes:jpeg,jpg,png,bmp,gif,svg',
            'tags_list' => 'required|array|min:1|max:3',
            'published_at' => 'required|date',
            'today' => 'date',
            'banned' => 'boolean'
            ];
    }
}
