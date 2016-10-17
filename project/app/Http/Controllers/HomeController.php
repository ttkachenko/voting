<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;
use Auth;
use App\Comment;

class HomeController extends Controller
{
    public function index()
    {


        return view("home.index");
    }
}
