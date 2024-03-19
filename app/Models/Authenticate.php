<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Authenticate extends Model
{
    use HasFactory;
    protected $table = "authenticate";
    protected $guarded = [];

    public static function get($token)
    {
        return DB::table("authenticate")
            ->where("token","=",$token)
            ->where("available_at",">=",date("Y-m-d H:i:s"))
            ->first();
    }

    public static function add(array $data)
    {
        $token = self::generateToken();
        $data['token'] = $token;
        $data['available_at'] = date("Y-m-d H:i:s", strtotime("+2 Hours"));
        return Authenticate::create($data);
    }

    public static function generateToken($length=12)
    {
        $token = bin2hex(random_bytes($length));

        // 혹시라도 모를 중복 체크
        while(true) {
            if (!DB::table("authenticate")
                ->where("token", "=", $token)
                ->exists()) {
                break;
            }

            $token = bin2hex(random_bytes($length));
        }

        return $token;
    }

    // 토큰 시간 끝났는지 확인하기
    public static function verify($token)
    {
        return DB::table("authenticate")
            ->where("token", "=", $token)
            ->where("available_at", ">=", date("Y-m-d H:i:s"))
            ->exists();
    }

}
