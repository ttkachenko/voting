<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use App\User;
class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        //dd($users);
        return view("home.index", ['users' => $users]);
    }
}
