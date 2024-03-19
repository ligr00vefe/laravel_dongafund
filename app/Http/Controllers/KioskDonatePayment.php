<?php

namespace App\Http\Controllers;

use App\Models\DonationProgram;
use App\Models\Donations;
use App\Models\KioskDonations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KioskDonatePayment extends Controller
{
    public function index(Request $request)
    {
        $kiosk_payment_url = $request->input("kiosk") ?? false;

        if (!$kiosk_payment_url) {
            return back()->with("error", "기부 프로그램을 선택해주세요");
        }

        $program = DB::table("view_kiosk_programs_and_payment")
            ->where("url", "=", $kiosk_payment_url)
            ->first() ?? false;

        if (!$program) return back()->with("error", "유효하지 않은 주소입니다.");

        $donation = DB::table("view_kiosk_payments_and_donations")
            ->where("url", "=", $kiosk_payment_url)
            ->first()->payment_status ?? false;

        if ($donation == "3") {
            return redirect("/")->with("error", "이미 약정서 작성이 끝났습니다,");
        }

        return view("kiosk.donate.index", [
            "program" => $program,
            "kiosk_url" => $kiosk_payment_url
        ]);
    }


    public function store(Request $request)
    {
        // 필수값
        $required = [
            "program_id" => "기부 프로그램",
//            "donation_type" => "기부 유형",
//            "donation_price" => "기부금액",
            "donator_type" => "기부자 유형",
//            "payment_type" => "납입 방법",
            "receipt_check" => "기부자 영수증 발급용도"
        ];

        foreach ($required as $key => $value) {
            if (!$request->input($key)) return back()->with("error", "{$value}는 필수값입니다.");
        }

        $params = [];

        $donation_price = $request->input("donation_price");

        // 여기에 정의한 컬럼은 null or 1만 받는다 (동의체크)
        $agreements = [ "receipt_check", "benefit_check", "tax_check" ];

        // 여기에 정의한 컬럼은 숫자만 받도록 지정한다.
        $numberOnly = [ "divide_count", "divide_price", "donation_price", "automatic_transfer_assign_day" ];

        foreach ($request->input() as $key => $value)
        {
            if (in_array(strtolower($key), $numberOnly)) $value = regexp("숫자", $value);
            if (in_array($key, $agreements) && $value != 1) return back()->with("error", "약관에 동의해 주십시오");
            $params[$key] = $value;
        }

        $contract_code = "KIOSK" . date("YmdHis") . bin2hex(random_bytes(12));

        // 혹시나 모를 중복체크
        while(true) {
            if (!DB::table("kiosk_donations")
                ->where("contract_code", "=", $contract_code)
                ->exists()) break;

            $contract_code = "KIOSK" . date("YmdHis") . bin2hex(random_bytes(12));
        }


        $params['contract_code'] = $contract_code;
        $params['payment_status'] = 3;

        $exist = DB::table("view_kiosk_payments_and_donations")
            ->where("url", "=", $request->input("kiosk_url"))
            ->first()->payment_status ?? false;

        if ($exist == "3") {
            return redirect("/")->with("error", "이미 약정서 작성이 끝났습니다,");
        }

        $execute = KioskDonations::create($params);
        $execute->ip = $request->getClientIp();
        if ($execute->save())
        {
            return redirect("/donate/complete");
        }

    }

}
