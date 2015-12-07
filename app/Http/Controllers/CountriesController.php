<?php

namespace itway\Http\Controllers;

use Illuminate\Http\Request;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Countries;
use Illuminate\Support\Facades\Response;

class CountriesController extends Controller
{
    public function queryCountry($query) {

        if (strlen($query) >= 3) {

            $countries = Countries::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $query . '%')->select('name', 'flag')->get('name', 'flag');
            return Response::json(['success' => 'true', 'results' => $countries]);
        }

        else return Response::json(['success' => 'false']);
    }
}
