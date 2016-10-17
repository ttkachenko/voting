<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        var_dump(date( "Y-m-d H:i" ));
        return view("home.index");
    }
}
