<?php

namespace App\Http\Controllers;

use App\Models\ContractStatus;
use App\Models\Donations;
use App\Payments\IamPort;
use App\Payments\KakaoPay;
use App\Payments\NicePay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignatureController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input("id") ?? false;
        if (!$id) return redirect("/")->with("error", "약정서가 존재하지 않습니다");

        $id = Donations::find($id);
        $clientIp = $request->getClientIp();

        if ($id->payment_status > 2) {
            return redirect("/")->with("error", "기부가 완료된 약정서입니다.");
        }

        if ($id->ip != $clientIp) {
            return redirect("/")->with("error", "약정서를 작성한 아이피와 다른 아이피에서 접속하였습니다.");
        }

        // customer_uid를 만들어야하는데 디비에 이미 있는 값이면 카운트를 + 한다. 최종적으로 "base64_encode(홍길동910101)_1"
        $customer_uid = base64_encode($id->name . $id->regNumber);
        $uidCount = 1;

        while(true)
        {
            if (!DB::table("customer_uid")
                ->where("name", "=", $customer_uid . "_{$uidCount}")->exists())
            {
                break;
            }
            $uidCount++;
        }

        $customer_uid .= $customer_uid . "_{$uidCount}";

        $goodsName = DB::table("donation_programs")
            ->where("id", $id->program_id)
            ->first()->subject ?? "";

        $mid = config('app.mid');
        $moid = config('app.moid');

        $price = $id->donation_type == "분할납부" ? (regexp("숫자", $id->donation_price)) / $id->divide_count : $id->donation_price;

        return view("signature.index", [
            "donation" => $id,
            "mid" => $mid,
            "moid" => $moid,
            "goodsName" => $goodsName,
            "price" => $price,
            "customer_uid" => $customer_uid
        ]);
    }

    public function store(Request $request)
    {
        $donation_id = $request->input("donation_id");
        $donation = Donations::find($donation_id);

        $clientIp = $request->getClientIp();
        if ($donation->ip != $clientIp) {
            return back()->with("error", "약정서를 작성한 아이피와 다른 아이피에서 접속하였습니다.");
        }


        /* 서명정보 먼저 저장 */
        $donation->signature_type = $request->input("signature_type");
        $donation->signature_pass = $request->input("signature_pass");
        $donation->signature_datetime = date("Y-m-d H:i:s");
        $donation->signature_save_id = $request->input("signature_save_id");
        $donation->receiptId = $request->input("receiptId") ?? null;
        $donation->signedData = $request->input("signedData") ?? null;

        if (!$donation->save()) {
            return false;
        }

        $payment = null;

        // 신용카드 결제시 나이스페이 연동
        if ($donation->payment_type == "신용카드")
        {
            $iamPort = new IamPort();
            $payment = $iamPort->payment($request);

            if ($payment['code'] != 1) {
                return back()->with("error", $payment['msg']);
            }
        }
        else if ($donation->payment_type == "카카오페이")
        {
            $kakaoPay = new KakaoPay();
            $kakaoPay->payment($request); // exit 됨
        }


        // 무통장입금, 자동이체는 결제없음



        /* 결제상태 저장 */
        $donation->payment_status = 3;
        if (!$donation->save()) {
            return false;
        }

        $remaining = 0;
        $completed = 1;
        $result  = 1;

        /* 기부방식에 따른 결제 남은 횟수 설정 */
        if ($donation->donation_type == "정기기부") {
            $remaining = 9999;
        }

        else if ($donation->donation_type == "분할납부") {
            $remaining = $donation->divide_count - 1;
        }
        /* ------------------------------- */

        /* 납입방법에 따른 남은 횟수 설정 */
        if ($donation->payment_type == "무통장입금") {

            // 무통장입금은 돈이 들어왔는지 관리자가 확인해주어야 하기때문에 남은횟수 1, 완료횟수 0
            // 하지만 편의를 위해서 result는 1로 처리하겠음
            $remaining = 1;
            $completed = 0;
        }

        else if ($donation->payment_type == "자동이체") {

            // 자동이체는 돈이 들어왔는지 관리자가 확인해주어야 하기때문에 완료횟수 0
            $completed = 0;

            // 남은횟수는 분할납부의 경우 분할횟수만큼 남음
            if ($donation->payment_type == "자동이체" && $donation->donation_type == "분할납부") {
                $remaining = $donation->divide_count;
            }
            // 일시기부일때는 남은횟수 1회
            else if ($donation->payment_type == "자동이체" && $donation->donation_type == "일시기부") {
                $remaining = 1;
            }
        }
        /* ---------------------------------- */


        $insert = DB::table("payments")
            ->insertGetId([
                "donation_id" => $donation->id,
                "customer_uid" => $payment['data']['customer_uid'] ?? "",
                "merchant_uid" => $payment['data']['merchant_uid'] ?? "",
                "completed" => $completed,
                "remaining" => $remaining,
                "result" => $result
            ]);

        $subsLog = true;


        if ($donation->payment_type == "신용카드") {

            $subsLog = DB::table("subscription_logs")
                ->insert([
                    "payment_id" => $insert,
                    "status" => $insert ? 1 : 2,
                    "returnValue" => json_encode($payment['data']['response']),
                    "comment" => "최초결제"
                ]);

        }



        $status = ContractStatus::insert([
            "donation_id" => $donation->id,
            "contract_status" => 1,
            "send_status" => 0
        ]);



        if ($insert && $subsLog && $status)
        {
            return redirect("/donate/complete?id={$request->input("program_id")}&type={$donation->donation_type}");
        }
        else
        {
            return redirect("/donate/complete?id={$request->input("program_id")}&type={$donation->donation_type}")->with("error",
                "결제에는 성공했지만 저장에 문제가 발생했습니다. 정기기부 혹은 분할납부를 선택하신 경우에 추가적인 기부가 안될수 있습니다. 사이트 관리자에게 연락부탁드리겠습니다");
        }
    }
}
