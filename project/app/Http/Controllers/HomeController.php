<?php

namespace App\Http\Controllers;

use DB;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view("home.index");
    }
}
