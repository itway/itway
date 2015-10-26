<?php namespace itway\Http\Controllers;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TeamsController extends Controller {


    public function index()
        {
         return view('pages.teams');
        }
}
