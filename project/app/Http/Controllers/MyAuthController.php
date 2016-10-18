<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\Http\Controllers\CodeController;
use App\Code;
use App\Http\Interfaces\UserInterface as UserInterface;
use \Illuminate\Database\QueryException as QueryException;
use Illuminate\Support\Facades\Input;

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

        $filename = "";
        if($request->hasFile('image')) {
            $file = Input::file('image');

            $filename = time(). '-' .$file->getClientOriginalName();

            $file->move(public_path().'/avatars/', $filename);
        }

        try{
            $this->userRepo->create($data['login'], $data['password'], $data['isMan'], $filename);


            if (Auth::attempt(['login' => $request->login, 'password' => $request->password])){
                return redirect('/');
            }
        }
        catch (QueryException $e)
        {
            $validator->errors()->add('login', "Введите другой логин. Введенный уже занят");
            $this->throwValidationException(
                $request, $validator
            );
        }
    }

    public function getLogin()
    {
        return view("auth.login");
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make([], [
        ]);

        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);

        if (!$isHuman)
        {
            $validator->errors()->add('capture', "Неверный текст с картинки");
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])){
            return redirect('/');
        }
        else
        {
            $validator->errors()->add('login', "Неверный логин / пароль");
            $this->throwValidationException(
                $request, $validator
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
