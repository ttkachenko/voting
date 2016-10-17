<?php
namespace App\Http\Repositories;
use App\Http\Interfaces\UserInterface as UserInterface;
use DB;
use App\User;
use Auth;


class UserRepository implements UserInterface
{

    public function getUserById($userId){
        return User::select('id', 'login', 'countVotes', 'imagePath')->where('id', '=', $userId)->first();
    }
}