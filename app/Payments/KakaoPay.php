<?php


namespace App\Payments;


use App\Models\ContractStatus;
use App\Models\DonationProgram;
use App\Models\Donations;
use App\Models\Payments;
use App\Models\SubscriptionLogs;
use App\Models\ViewDonationsAndPayments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KakaoPay
{

    /*
     * -----------------------------------------------------------------
     *
     * 카카오페이의 경우 기부방법 별 CID가 존재함. (즉, 3개)
     * 다만, 결제는 정기기부로 일시, 정기, 분할 다 구현하고
     * CID만 각각의 맞는 결제에 붙혀주는 방식으로 구현함.
     *
     * ------------------------------------------------------------------
     * */

    private int $donation_id;
    private int $program_id;
    private string $donation_name;
    private string $donation_subject;
    private string $regNumber;
    private string $donation_type;
    private string $merchant_uid;
    private string $donation_price;

    private string $app_admin_key = "72f48b731768b36fabe12435a58b944a";
    private string $subscription_cid = "CT11651834";
    private string $once_cid = "CT21804830";


    public function payment($request)
    {
        $donation = Donations::find($request->input("donation_id"));
        $payment = DonationProgram::find($donation->program_id);
        $this->donation_name = $donation->name ?? "동아대학교익명";
        $this->donation_subject = $payment->subject ?? "";
        $this->merchant_uid = $donation->merchant_uid;
        $this->regNumber = $donation->regNumber ?? "6038201274";
        $this->donation_id = $donation->id;
        $this->program_id = $donation->program_id;
        $this->donation_type = $donation->donation_type;
        $this->donation_price = $donation->donation_type != "분할납부" ? $donation->donation_price : $donation->divide_price;

        $this->once();
    }


    public function once()
    {

        // payment id를 먼저 만들어서 리턴url에 주기 위함.
        $payment = new Payments();
        $payment->donation_id = $this->donation_id;
        $payment->completed = 0;
        $payment->remaining = 0;
        $payment->result = 0;
        $payment->save();

        $subscription = new SubscriptionLogs();
        $subscription->payment_id = $payment->id;
        $subscription->status = 2;
        $subscription->comment = "최초결제";
        $subscription->save();


        $returnUrl = "";
        $cid = "";



        if ($this->donation_type == "일시기부") {
            $cid = $this->once_cid;
            $returnUrl = request()->getSchemeAndHttpHost() . "/donate/kakaopay/complete?id={$this->donation_id}&type={$this->donation_type}&kakao=1&payment_id={$payment->id}&subs={$subscription->id}";
        }
        else if ($this->donation_type == "정기기부" || $this->donation_type == "분할납부") {
            $cid = $this->subscription_cid;
            $returnUrl = request()->getSchemeAndHttpHost() . "/donate/kakaopay/getSid?id={$this->donation_id}&type={$this->donation_type}&kakao=1&payment_id={$payment->id}&subs={$subscription->id}";
        }

        $partner_user_id = base64_encode($this->donation_name . $this->regNumber);

        $req = [
            'cid' => $cid,
            'partner_order_id' => $this->merchant_uid,
            'partner_user_id' => $partner_user_id,
            'item_name' => $this->donation_subject,
            "quantity" => 1,
            "total_amount" => $this->donation_price,
            "tax_free_amount" => 0,
            "approval_url" => $returnUrl,
            "fail_url" => $returnUrl,
            "cancel_url" => $returnUrl
        ];

        $curl_headers = [
            "Authorization: KakaoAK {$this->app_admin_key}",
            'Content-type: application/x-www-form-urlencoded;charset=utf-8'
        ];

        $result = json_decode(curl("https://kapi.kakao.com/v1/payment/ready", $req, $curl_headers));


        if (!isset($result->tid)) {
            return back()->with("error", "오류가 발생했습니다. {$result->code}");
        }



        // 성공했다면 2차로 다시 payment 저장
        $payment->kakao_tid = $result->tid;
        $payment->completed = 1;
        $payment->partner_user_id = $partner_user_id;
        $payment->save();

        $subscription->returnValue = json_encode($result);
        $subscription->save();

//        echo "<style>";
//        echo "body { margin:0; padding: 0; }";
//        echo "</style>";
        echo "<script>";
        echo "window.open('{$result->next_redirect_pc_url}', '_blank', 'width=500,height=500')";
        echo "</script>";
//        echo "<iframe src='{$result->next_redirect_pc_url}' style='width: 100%; height: 100vh; border: none; margin:0; padding: 0;'></iframe>";
        exit;

    }

    // 정기기부 첫 회 성공 시 들어와서 sid 발급받는 메소드 (다음 결제때부터 sid를 사용)
    public function getSid(Request $request)
    {
        $payment = Payments::find($request->input("payment_id"));
        $subscription = SubscriptionLogs::find($request->input("subs"));

        $pg_token = $request->input("pg_token");
        $tid = $payment->kakao_tid;
        $donation = Donations::find($request->input("id"));
        $partner_order_id = $donation->merchant_uid;
        $partner_user_id = $payment->partner_user_id;


        $req = [
            "cid" => $this->subscription_cid,
            "tid" => $tid,
            "partner_order_id" => $partner_order_id,
            "partner_user_id" => $partner_user_id,
            "pg_token" => $pg_token
        ];


        $curl_headers = [
            "Authorization: KakaoAK {$this->app_admin_key}",
            'Content-type: application/x-www-form-urlencoded;charset=utf-8'
        ];

        $result = json_decode(curl("https://kapi.kakao.com/v1/payment/approve", $req, $curl_headers));

        if (!isset($result->tid)) {
            echo "<script>";
            echo "alert('키를 받아오는데 실패했습니다. 해당 메시지를 관리자에게 보여주세요. {$result->msg}')";
            echo "self.close();";
            echo "</script>";
            return false;
        }

        $donation->payment_status = 3;
        $payment->merchant_uid = $partner_order_id;
        $payment->result = 1;
        $payment->kakao_sid = $result->sid;
        $payment->remaining = 9999;

        $subscription->status = 1;
        $subscription->returnValue = json_encode($result);

        $status = ContractStatus::insert([
            "donation_id" => $donation->id,
            "contract_status" => 1,
            "send_status" => 0
        ]);

        if ($payment->save() && $donation->save() && $status && $subscription->save())
        {
            echo "<script>";
            echo "window.opener.location.href='/donate/complete?id={$donation->program_id}&type={$donation->donation_type}';";
            echo "self.close();";
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo "alert('저장에 실패했습니다.');";
            echo "opener.history.go(-2);";
            echo 'self.close();';
            echo "</script>";
        }

        exit;

    }

    // 일시기부 성공일때 들어오는 메소드
    public function complete(Request $request)
    {
        $payment = Payments::find($request->input("payment_id"));
        $donation = Donations::find($request->input("id"));
        $subscription = SubscriptionLogs::find($request->input("subs"));

        $payment->remaining = 0;
        $payment->result = 1;

        $donation->payment_status = 3;

        $subscription->status = 1;


        $status = ContractStatus::insert([
            "donation_id" => $donation->id,
            "contract_status" => 1,
            "send_status" => 0
        ]);

        if ($payment->save() && $donation->save() && $status && $subscription->save())
        {
            echo "<script>";
            echo "window.opener.location.href='/donate/complete?id={$donation->program_id}&type={$donation->donation_type}';";
            echo "self.close();";
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo "alert('저장에 실패했습니다.');";
            echo "opener.history.go(-2);";
            echo 'self.close();';
            echo "</script>";
        }
        exit;
    }


    public function monthly($task)
    {
        $partner_order_id = $task->merchant_uid;
        $partner_user_id = $task->partner_user_id;
        $price = $task->donation_type != "분할납부" ? $task->donation_price : $task->divide_price;

        $req = [
            "cid" => $this->subscription_cid,
            "sid" => $task->kakao_sid,
            "partner_order_id" => $partner_order_id,
            "partner_user_id" => $partner_user_id,
            "quantity" => 1,
            "total_amount" => $price,
            "tax_free_amount" => 0,
        ];

        $curl_headers = [
            "Authorization: KakaoAK {$this->app_admin_key}",
            'Content-type: application/x-www-form-urlencoded;charset=utf-8'
        ];

        $result = json_decode(curl("https://kapi.kakao.com/v1/payment/subscription", $req, $curl_headers));


        $success = false;
        $params = [];

        if (isset($result->aid))
        {
            $success = true;
            $params = [
                "payment_id" => $task->payments_id,
                "status" => 1,
                "returnValue" => json_encode($result)
            ];

        }
        else
        {

            $params = [
                "payment_id" => $task->payments_id,
                "status" => 2,
                "returnValue" => json_encode($result)
            ];

        }

        SubscriptionLogs::record($params);
        if ($success) {
            $payment = Payments::find($task->payments_id);
            $payment->completed = $payment->completed + 1;
            $payment->remaining = $payment->remaining - 1;
            $payment->save();
        }
    }

}
