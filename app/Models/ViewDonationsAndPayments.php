<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewDonationsAndPayments extends Model
{
    use HasFactory;
    protected $table = "view_donations_and_payments";
    public string $name, $birth, $tel;

    // 정기기부, 분할납부 종료안된 기부가져오기
    public static function unfinished($day)
    {

        $possible = [
            10, 25
        ];

        if (!in_array($day, $possible)) return false;

        // 이번달 결제건은 제외. 이번달 이전에 결제된 건에 대해서만 정기결제, 분할납부가 이뤄져야 한다
        $ym = date("Y-m");
        $ymd = date("Y-m-d", strtotime($ym. "-01"));

        return DB::table("view_donations_and_payments")
            ->whereIn("donation_type", [ "정기기부", "분할납부" ])
            ->whereIn("payment_type", [ "신용카드", "카카오페이" ])
            ->where("payment_status", "=", 3)
            ->where("remaining", "!=", 0)
            ->where("automatic_transfer_assign_day", "=", $day)
            ->where("result", "=", "1")
            ->where("created_at", "<", $ymd)
            ->get();

    }



    public static function history()
    {

    }

}
