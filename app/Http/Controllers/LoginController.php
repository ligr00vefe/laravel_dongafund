<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    protected $redirectTo = "/";

    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return "account_id";
    }

    public function index(Request $request)
    {
        return view("auth.login.index", [
            "return" => $request->input("return") ?? ""
        ]);
    }

    public function store(Request $request)
    {
        $credentials = $request->only('account_id', "password");

        if (Auth::attempt($credentials)) {

            $token = bin2hex(random_bytes(12));
            Auth::user()->remember_token = $token;
            Auth::user()->save();
            Cookie::queue(Cookie::make("email", Auth::user()->email, 60));
            Cookie::queue(Cookie::make("remember_token", $token, 60));

            $redirect = $request->input("return") ?? false;

            if ($redirect) {
                return redirect($redirect);
            }

            return redirect()->intended('/');
        }
        else {
            return back()->with("error", "아이디가 없거나 비밀번호가 틀렸습니다");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/')->with("msg", "로그아웃 되었습니다");
    }
}
