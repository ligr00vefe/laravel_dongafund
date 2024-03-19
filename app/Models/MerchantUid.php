<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MerchantUid extends Model
{
    use HasFactory;
    protected $table = "merchant_uid";

    /*
     * 중복 체크 후 인서트
     * 중복이면 return false
     * */
    public static function dupsert($uid)
    {
        if (DB::table("merchant_uid")
            ->where("name", "=", $uid)
            ->exists()
        ) {
            return false;
        }

        return DB::table("merchant_uid")->insertGetId([
            "name" => $uid
        ]);
    }

    // merchant_uid 만들기
    public static function generate($program_id)
    {
        $program = DonationProgram::find($program_id);
        $subject = base64_encode($program->subject);
        $merchantCount = 1;

        while(true) {
            if (MerchantUid::dupsert($subject . "_" . $merchantCount)) break;
            $merchantCount++;
        }

        return $subject . "_" . $merchantCount;
    }
}
