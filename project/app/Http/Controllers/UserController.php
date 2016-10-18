<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Interfaces\UserInterface as UserInterface;
use App\Http\Interfaces\VoteInterface as VoteInterface;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Validator;

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

    public function getEdit()
    {
        if(!Auth::check())
            return view('errors.503', ['error' => "Please login!"]);
        return view('user.edit');
    }

    public function postEdit(Request $request)
    {
        if(!Auth::check())
            return view('errors.503', ['error' => "Please login!"]);

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $data = $request->all();

        $filename = Auth::user()->imagePath;
        if($request->hasFile('image')) {
            $file = Input::file('image');

            $filename = time(). '-' .$file->getClientOriginalName();

            Image::make($file)->resize(50, 50)->save("avatars/".$filename);
        }

        $this->userRepo->editCurrentUser($data['isMan'], $filename);
        return redirect('/edit');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image' => 'max:5120|mimes:jpeg,jpg,gif,png',
        ]);
    }
}
