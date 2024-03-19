<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $remember_token = Cookie::get("remember_token");
        if (!Auth::id()) {
            return redirect("/auth/login?return=".$request->getPathInfo())->with("error", "로그인 해주세요");
        }

        if (!User::verify($remember_token)) {
            return redirect("/auth/login?return=".$request->getPathInfo())->with("error", "잘못된 접근입니다.");
        }

        return $next($request);
    }
}
