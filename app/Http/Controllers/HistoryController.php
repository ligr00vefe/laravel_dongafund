<?php

namespace App\Http\Controllers;

use App\Models\Authenticate;
use App\Models\ViewDonationLogs;
use App\Models\ViewDonationsAndPayments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // 현재는 카카오본인인증으로 받는 auth_token 만 있다.
        // 로그인으로 발급받는 token으로 조회하는 기능도 추가되어야 한다
        $auth_token = Cookie::get("auth_token");
        if (!isset($auth_token) || $auth_token == "") {
            $return = urlencode("/history");
            return redirect("/auth/check?return={$return}");
        }

        // 토큰 시간 다 됐으면 지우고 다시 본인인증
        if (!Authenticate::verify($auth_token)) {
            $return = urlencode("/history");
            return redirect("/auth/check?return={$return}")->withCookie("auth_token", "", 0);
        }


        if ($auth_token) {
            $info = Authenticate::get($auth_token);
        }


        $donations = new ViewDonationLogs();
        $donations->name = $info->name;
        $donations->tel = $info->tel;
        $donations->birth = substr($info->birth, 2);
        $lists = $donations->get();
        $total = $donations->total();

//        if ($lists['code'] == 3) {
//            return back()->with("error", $lists['msg']);
//        }

        return view("history.index", [
            "lists" => $lists,
            "total" => $total,
            "name" => $info->name,
            "tel" => $info->tel,
            "birth" => $info->birth
        ]);
    }

    public function show(Request $request)
    {
        return view("history.show", [

        ]);
    }
}
