<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

use App\Http\Interfaces\UserInterface as UserInterface;
use App\Http\Interfaces\VoteInterface as VoteInterface;

class UserController extends Controller
{

    public function __construct(UserInterface $userRepo, VoteInterface $voteRepo)
    {
        $this->userRepo = $userRepo;
        $this->voteRepo = $voteRepo;
    }

    public function info($userId)
    {
        $user = $this->userRepo->getUserById($userId);
        if ($user==null)
            return view('errors.503', ['error' => "User does'not exist!"]);
        if(Auth::check())
            $user['vote'] = $this->voteRepo->getUserVote($userId);
        return view('user.info', ['user' => $user]);
    }

    public function edit()
    {
        return view('user.edit');
    }
}
