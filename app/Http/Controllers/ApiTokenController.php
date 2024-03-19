<?php

namespace App\Http\Controllers;

use App\api\Token;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function get(Request $request) // 토큰 발급
    {
        return Token::get($request);
    }

    public function extend(Request $request) // 토큰 시간 연장
    {
        return Token::extend($request);
    }

    public function getHeaderName(Request $request) {
        return response()->json([ "code" => 1, "msg" => "토큰 발급 성공", "data" => $token ]);
    }
}
