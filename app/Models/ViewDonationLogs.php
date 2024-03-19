<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewDonationLogs extends Model
{
    use HasFactory;
    protected $table = "view_donation_logs";
    public string $name, $tel, $birth;

    public function verify()
    {
        $return = [ "code" => 1 ];

        if (!$this->name || $this->name == "" || !isset($this->name)) {
            $return = [ "code" => 3, "msg" => "기부자 이름이 없습니다.", "data" => $this->name ?? null ];
        }

        if (!$this->tel || $this->tel == "" || !isset($this->tel)) {
            $return = [ "code" => 3, "msg" => "기부자 전화번호가 없습니다.", "data" => $this->tel ?? null ];
        }

        if (!$this->birth || $this->birth == "" || !isset($this->birth)) {
            $return = [ "code" => 3, "msg" => "기부자 생년월일이 없습니다.", "data" => $this->birth ?? null ];
        }

        return $return;
    }

    // 한 사람의 모든 기부 내역을 가져온다
    public function get ()
    {
        $verify = $this->verify();

        if ($verify['code'] != 1) {
            return $verify;
        }

        return DB::table("view_donation_logs")
            ->where("name", "=", $this->name)
            ->where("tel", "=", $this->tel)
            ->where("regNumber", "like", "%{$this->birth}%")
            ->orderByDesc("id")
            ->get();
    }

    public function total ()
    {
        $verify = $this->verify();

        if ($verify['code'] != 1) {
            return $verify;
        }

        return DB::table("view_donation_logs")
            ->selectRaw("sum(total_price) as price")
            ->where("name", "=", $this->name)
            ->where("tel", "=", $this->tel)
            ->where("regNumber", "like", "%{$this->birth}%")
            ->orderByDesc("id")
            ->first();
    }
}
