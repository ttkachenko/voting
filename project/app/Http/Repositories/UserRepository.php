<?php
namespace App\Http\Repositories;
use App\Http\Interfaces\UserInterface as UserInterface;
use DB;
use App\User;
use Auth;


class UserRepository implements UserInterface
{

    public function getUserById($userId){
        return User::select('id', 'login', 'countVotes', 'imagePath', 'isMan')->where('id', '=', $userId)->first();
    }

    public function create($login, $password, $isMan, $imagePath){
        DB::table('users')->insert(
            [
                'login' => $login,
                'password' => bcrypt($password),
                'isMan' => (boolean)$isMan,
                'imagePath' => $imagePath,
            ]
        );
    }


    public function editCurrentUser($isMan, $imagePath)
    {
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update(['isMan' => (boolean)$isMan, 'imagePath' => $imagePath]);
    }



}