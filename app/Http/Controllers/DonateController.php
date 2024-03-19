<?php

namespace App\Http\Controllers;

use App\Models\DonationProgram;
use App\Models\Donations;
use App\Models\MerchantUid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
    public function index(Request $request)
    {
        $host = $request->input("host");
        $program_id = $request->input("program") ?? false;
        $kiosk_payment_url = $request->input("kiosk") ?? false;

        if (!$program_id && !$kiosk_payment_url) {
            return back()->with("error", "기부 프로그램을 선택해주세요");
        }

        $program = false;

        if ($program_id) {
            $program = DonationProgram::find($program_id);
            if (!$program) return back()->with("error", "기부 프로그램을 선택해주세요");
        }

        if ($kiosk_payment_url && !$program_id) {
            $program = DB::table("view_kiosk_programs_and_payment")
                ->where("url", "=", $kiosk_payment_url)
                ->first();
            if (!$program) return back()->with("error", "유효하지 않은 주소입니다.");
        }

        return view("donate.index", [
            "program" => $program,
            "host" => $host
        ]);
    }

    public function show($id)
    {
        return redirect("/");
    }

    public function store(Request $request)
    {

        // 필수값
        $required = [
            "program_id" => "기부 프로그램",
            "donation_type" => "기부 유형",
            "donation_price" => "기부금액",
            "donator_type" => "기부자 유형",
            "payment_type" => "납입 방법",
            "receipt_check" => "기부자 영수증 발급용도"
        ];

        foreach ($required as $key => $value) {
            if (!$request->input($key)) return back()->with("error", "{$value}는 필수값입니다.");
        }

        $params = [];

        $program = DonationProgram::find($request->input("program_id"));
        $donation_price = $request->input("donation_price");
        $payment_method = explode(",", $program->payment_method);
        $payment_type = $request->input("payment_type") ?? false;

        if (!in_array($payment_type, $payment_method)) {
            return back()->with("error", "결제방법이 잘못되었습니다.");
        }


        // 기부금 고정이 아닐 때 1,3,5,10 만원이 아니면 유효성 검사 실패 -> 김대현요청으로주석, 기부금액 자유롭게 쓸 수 있도록 해달라. 21.08.31
//        $donation_price_kinds = [ "10,000 원", "30,000 원", "50,000 원", "100,000 원" ];
//        if ($program->fixing_check == 2 && !in_array($donation_price, $donation_price_kinds)) {
//            return back()->with("error", "잘못된 접근입니다.");
//        }

        // 여기에 정의한 컬럼은 null or 1만 받는다 (동의체크)
        $agreements = [ "receipt_check", "benefit_check", "tax_check" ];

        // 여기에 정의한 컬럼은 숫자만 받도록 지정한다.
        $numberOnly = [ "divide_count", "divide_price", "donation_price", "automatic_transfer_assign_day" ];

        foreach ($request->input() as $key => $value)
        {
            if (in_array(strtolower($key), $numberOnly)) $value = regexp("숫자", $value);
            if (in_array(strtolower($key), $agreements) && $value != 1) return back()->with("error", "약관에 동의해 주십시오");
            $params[$key] = $value ?: null;
        }

        $contract_code = "WEB" . date("YmdHis") . bin2hex(random_bytes(12));

        // 혹시나 모를 중복체크
        while(true) {
            if (!DB::table("donations")
                ->where("contract_code", "=", $contract_code)
                ->exists()) break;

            $contract_code = "WEB" . date("YmdHis") . bin2hex(random_bytes(12));
        }


        $params['contract_code'] = $contract_code;


        $execute = Donations::create($params);
        $execute->ip = $request->getClientIp();

        // 상품주문아이디 만들기
        $merchant_uid = MerchantUid::generate($execute->program_id);
        $execute->merchant_uid = $merchant_uid;

        if ($execute->save())
        {
            // 자동이체의 경우 비동기로 왔으므로 구분해주기
            if ($request->getRequestUri() == "/async/donate/add") {
                return response()->json([
                    "code" => 1,
                    "msg" => "success...!",
                    "data" => [
                        "id" => $execute->id,
                        "type" => $execute->donation_type
                    ]
                ]);
            }

            return redirect("/signature?id={$execute->id}&test={$request->input("divide_count")}");
        }
        else
        {
            if ($request->getRequestUri() == "/async/donate/add") {
                return response()->json([
                    "code" => 2,
                    "msg" => "fail...!",
                    "data" => false
                ]);
            }
        }

    }

}
