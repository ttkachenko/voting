<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\Http\Controllers\CodeController;
use App\Code;
use App\Http\Interfaces\UserInterface as UserInterface;
use Illuminate\Database\QueryException as QueryException;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

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

            Image::make($file)->resize(50, 50)->save("avatars/".$filename);
        }

        try{
            $this->userRepo->create($data['login'], $data['password'], $data['isMan'], $filename);


            if (Auth::attempt(['login' => $request->login, 'password' => $request->password])){
                return redirect('/');
            }
        }
        catch (QueryException $e)
        {
            $validator->errors()->add('login', "Такой логин уже есть");
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
            $validator->errors()->add('capture', "Текст с картинки введен неверно");
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
            'login' => 'required|between:4,15|unique:users|regex:/(^[A-Za-z0-9 ]+$)+/',
            'password' => 'required|between:5,25|regex:*[0-9]*',
            'image' => 'max:5120|mimes:jpeg,jpg,gif,png',
        ]);
    }


    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
