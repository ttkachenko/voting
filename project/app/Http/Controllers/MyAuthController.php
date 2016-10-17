<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\Http\Controllers\CodeController;
use App\Code;
use App\Http\Interfaces\UserInterface as UserInterface;

class MyAuthController extends Controller
{

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getRegister()
    {
        return view("auth.register");
    }

    public function postRegister(Request $request)
    {
       $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $data = $request->all();
        $this->userRepo->create($data['login'], $data['password'], $data['isMan'], $data['imagePath']);

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])){
            return redirect('/');
        }

    }

    public function getLogin()
    {
        return view("auth.login");
    }

    public function postLogin(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }


        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])){
            return redirect('/');
        }
        else
        {
            $this->throwValidationException(
                "bad", "datas"
            );
        }

    }

    public function getLogout()
    {
        Auth::guard($this->getGuard())->logout();
        return redirect('/');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required',
            'password' => 'required|min:6',
        ]);
    }


    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
