<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Validator;
use Auth;
use App\Http\Controllers\CodeController;
use App\Code;

class MyAuthController extends Controller
{
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

        $this->create($request->all());

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


    protected function create(array $data)
    {
        DB::table('users')->insert(
            [
                'login' => $data['login'],
                'password' => bcrypt($data['password']),
                'isMan' => 0,
                'imagePath' => $data['imagePath'],
            ]
        );
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
