<?php

namespace Itway\Validation\Event;

use itway\Http\Requests\Request;

class EventRequest extends Request
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
            'name' => 'required|string|min:3|max:120',
            'description' => 'required|string|min:3|max:120',
            'time' => 'required|string|min:3|max:24', 
            'date' => 'required|string', 
            'organizer' => 'required|string|min:3|max:120', 
            'place' => 'required|string|min:3|max:120', 
            'max_people_number' => 'number', 
            'organizer_link' => 'url' 
            ];
    }
}
