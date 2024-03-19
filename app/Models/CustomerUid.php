<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerUid extends Model
{
    use HasFactory;
    protected $table = "customer_uid";

    public static function dupsert($uid)
    {
        if (DB::table("customer_uid")
            ->where("name", "=", $uid)
            ->exists()
        ) {
            return false;
        }

        return DB::table("customer_uid")->insertGetId([
            "name" => $uid
        ]);
    }

    // customer_uid 만들기
    public static function generate($donation_id)
    {
        $customerCount = 1;

        $donation = Donations::find($donation_id);
        $customer = base64_encode($donation->credit_card_number);

        while(true) {
            if (self::dupsert($customer . "_" . $customerCount)) break;
            $customerCount++;
        }

        return $customer . "_" . $customerCount;
    }
}
