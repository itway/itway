<?php

namespace itway\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use itway\Http\Requests;
use Itway\Models\User;

class LanguageController extends Controller {

	public function chooser(Request $request)
    {
        $select = $request->input('locale');
        $user = User::find(Auth::id());
        if($user) {
            $user->update(
                ['locale' => $select]
            );
        }
        $url = $request->url;
        $replacedUrl = substr_replace( $url,$select,0, 2);

            return redirect()->to($replacedUrl)->withCookie(cookie('locale', $select, 525600));

    }

}
