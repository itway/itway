<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/27/2015
 * Time: 8:17 PM
 */

namespace Itway\Validation\Post;

use itway\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Itway\Models\Post;
use Input;
use Toastr;

class PostsFormRequest extends Request{

    protected $rules = [
        'title' => 'required|min:3|max:120',
        'preamble' => 'required|min:100|max:300',
        'image' =>'image_size:>=450,>=250|mimes:jpeg,jpg,png,bmp,gif,svg',
        'body' => 'required|min:300|max:500000',
        'tags_list' => 'required|array|min:1|max:10',
        'published_at' => 'required|date',
        'youtube_link' => 'min:6|max:120',
        'github_link' => 'url||min:6|max:120'
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
            Toastr::warning("please login to create post", $title = "Don't have a permission ", $options = []);

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
