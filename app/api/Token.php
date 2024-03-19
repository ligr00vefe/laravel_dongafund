<?php


namespace App\api;


use Illuminate\Support\Facades\DB;

class Token
{

    public static function get($request)
    {

        /*
         * 보내기: token은 authorization 헤더에 = Bearer $token 형태로
         * 받기: $token = $request->header("authorization");
         * */

        $token = bin2hex(random_bytes(18)); // 랜덤바이트
        $name = $request->input("name") ?? "키오스크1"; // 키오스크 이름
        /*$ip = $request->getClientIp(); 클라이언트 아이피를 받아서는 안될것 같음*/
        $ip = $request->input("ip"); // 아이피

        $insert = DB::table("tokens")
            ->insert([
                "name" => $name, // 키오스크 이름
                "token" => $token, // 랜덤함수로 만든 값
                "level" => 1, // 레벨?
                /*"ip" => $request->getClientIp(),*/ /*받는 쪽에서 getClientIp 는 안먹을꺼 같다 아이피르 필드값에 받아야 할듯*/
                "ip" => $ip, // 아이피
                "available" => date("Y-m-d H:i:s", strtotime("+2 hours")), // 살아있는 시간
            ]);

        if ($insert)
        {
            return response()->json([ "code" => 1, "msg" => "토큰 발급 성공", "data" => $token ]);
        }
        else
        {
            return response()->json([ "code" => 2, "msg" => "fail", "data" => false ]);
        }
    }

    /*
     * 토큰 시간 연장하기
     * request: token
     */
    public static function extend($request)
    {
        /*$ip = $request->getClientIp(); 클라이언트 아이피를 받아서는 안될것 같음*/
        $ip = $request->input("ip");
        $token = $request->input("token") ?? false;

        if (!$token) {
            return response()->json([ "code" => 99, "msg" => "토큰이 없습니다. 토큰을 먼저 발행받아 주세요.", "data" => false ]);
        }

        if (!self::exists($ip, $token)) {
            return response()->json([
                "code" => 98,
                "msg" => "토큰이 만료됐거나 토큰정보가 틀립니다.",
                "data" => false
            ]);
        }

        $update = DB::table("tokens")
            ->where("ip", "=", $ip)
            ->where("token", "=", $token)
            ->update([
                "available" => date("Y-m-d H:i:s", strtotime("+2 hours"))
            ]);

        if ($update)
        {
            return response()->json([ "code" => 1, "msg" => "토큰시간을 연장했습니다.", "data" => true ]);
        }
        else
        {
            return response()->json(["code" => 2, "msg" => "토큰시간 연장에 실패했습니다.", "data" => false ]);
        }
    }

    /*
     * 토큰 유효한지 검증하기
     * 검증값: ip, token, 시간
     * */
    public static function exists($ip, $token)
    {
        return DB::table("tokens")
            ->where("ip", "=", $ip)
            ->where("token", "=", $token)
            ->where("available", ">=", date("Y-m-d H:i:s"))
            ->exists();
    }


    /*
     * 토큰 유효시간 만료됐는지 검증하기
     * 검증값: token
     * */
    public static function expirate($token)
    {
        return DB::table("tokens")
            ->where("token", "=", $token)
            ->where("available", ">=", date("Y-m-d H:i:s"))
            ->exists();
    }

}
