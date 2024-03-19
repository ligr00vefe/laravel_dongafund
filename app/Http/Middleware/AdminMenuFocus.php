<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMenuFocus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // 관리자 사이드 메뉴 포커스 변수 지정하는 미들웨어
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->route()->getName();
        $admSideMenu = "";


        switch ($uri)
        {
            case "admin.donate.program.index":
                $admSideMenu = "program";
                break;
            case "admin.contents.news.index":
                $admSideMenu = "news";
                break;
            case "admin.contents.periodicals.index":
                $admSideMenu = "periodicals";
                break;
            case "admin.contents.contract.index":
                $admSideMenu = "contract";
                break;
            case "admin.auth.index":
                $admSideMenu = "auth";
                break;
            case "admin.privacy.agreement.index":
                $admSideMenu = "agreement";
                break;
            case "admin.inquire.agreement.index":
                $admSideMenu = "inquire";
                break;
        }

        view()->share("admSideMenu", $admSideMenu);


        return $next($request);
    }
}
