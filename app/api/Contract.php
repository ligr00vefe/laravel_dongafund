<?php


namespace App\api;


use Illuminate\Support\Facades\DB;

class Contract extends Token
{
    public static function incomplete($request) // 불완전 정보 수신
    {
        $expirate = self::expirate($request->token); // 토큰 유효시간 만료 검사
        if (!$expirate) {
            return response()->json([
                "code" => 99,
                "msg" => "토큰 검증 실패",
                "data" => false,
            ]);
        }


        $name = $request->input("name") ?? "";
        $hp = $request->input("hp");
        $payment = $request->input("payment");
        $code = $request->input("code") ?? 0; // 키오스크에서 등록된 기부프로그램을 웹에서도 등록 혹은 구분할 수 있도록 코드를 받음
        $count = $request->input("count") ?? 0;

        if (!$code)
        {
            return response()->json([
                "code" => 89,
                "msg" => "요청 정보가 없습니다",
                "data" => $code
            ]);
        }

        $url = bin2hex(random_bytes(12));

        $insert = DB::table("kiosk_payments")
            ->insert([
                "donation_code" => $code,
                "completed" => 1,
                "remaining" => $count - 1,
                "result" => 1,
                "url" => $url
            ]);

        if ($insert)
        {
            return response()->json([
                "code" => 1,
                "msg" => "success...!",
                "data" => "/kiosk/donate?kiosk={$url}"
            ]);
        }
        else
        {
            return response()->json([
                "code" => 2,
                "msg" => "fail...",
                "data" => false
            ]);
        }

    }
}
