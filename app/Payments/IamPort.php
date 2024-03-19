<?php


namespace App\Payments;


use App\Models\CustomerUid;
use App\Models\DonationProgram;
use App\Models\Donations;
use App\Models\MerchantUid;
use App\Models\Payments;
use App\Models\SubscriptionLogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IamPort
{

    private string $token; // payment에서 만들어짐
    public string $customer_uid; // 빌링키 만들 때 만들어짐
    public string $merchant_uid; // payment에서 만들어짐
    public string $donation_subject;
    public string $donation_price;
    public string $donation_type;
    public string $buyer_name;
    public string $buyer_tel;
    public string $buyer_email;
    public string $donation;

    public function payment($request)
    {
        $token = $this->getToken();
        if (isset($token->code) && $token->code != 0) {
            return [ "code" => 99, "msg" => $token->message, "data" => false ];
        }
        $this->token = $token->response->access_token;

        $billingKey = $this->requestBillingKey($request);
        if (isset($billingKey->code) && $billingKey->code != 0) {
            return [ "code" => 98, "msg" => $billingKey->message, "data" => false ];
        }

        $donation = Donations::find($request->input("donation_id"));
        $this->merchant_uid = $donation->merchant_uid;
        $this->donation_subject = $donation->program->subject;
        $this->buyer_name = $donation->donator_type != "익명" ? $donation->name : "동아대학교익명";
        $this->buyer_tel = $donation->tel ?: "0512006012";
        $this->buyer_email = $donation->tel ?: "test@test.com"; // 익명일때 이메일 어떻게 처리할건지 물어보기
        $this->donation_type = $donation->donation_type;
        $this->donation_price = $donation->donation_type != "분할납부" ? $donation->donation_price : $donation->divide_price;

        $this->donation = $donation;
        return $this->once();
    }

    private function getToken()
    {
        // code가 0일때 성공이므로 주의! (0 == false)
        $response = Http::post('https://api.iamport.kr/users/getToken', [
            'imp_key' => '8762989088321354',
            'imp_secret' => 'vt1JRKHHtlZrbVt3MQkYdPrKrXQwSLunev66fOOJaNblJEovvJtJyUu0SkwK508kwfrM4gwe3HAMmYiS',
        ]);

        return json_decode($response);
    }

    // 빌링키 발급받기
    private function requestBillingKey($request)
    {
        $this->customer_uid = CustomerUid::generate($request->input("donation_id"));
        $donation = Donations::find($request->input("donation_id"));

        $credit_card_expiration = $donation->credit_card_expiration;

        // 나이스페이의 경우 YYYY-MM 형태로 나와야 하기 때문에 해당 형태로 바꿔줌
        $expiry_y = "20" . substr($credit_card_expiration, 0, 2);
        $expiry_m = sprintf('%02d', substr($credit_card_expiration, 2, 4));
        $expiry = $expiry_y . "-" . $expiry_m;

        // code가 0일때 성공이므로 주의! (0 == false)
        $response = Http::withHeaders([
            "Authorization" => $this->token
        ])->post("https://api.iamport.kr/subscribe/customers/{$this->customer_uid}", [
            "card_number" => $donation->credit_card_number,
            "expiry" => $expiry, // 나이스페이의 경우 YYYY-MM
            "birth" => substr($donation->regNumber, 0, 6),
            "pwd_2digit" => $request->input("pwd_2digit")
        ]);

        return json_decode($response);
    }

    public function once()
    {

        $response = Http::withHeaders([
            "Authorization" => $this->token
        ])->post('https://api.iamport.kr/subscribe/payments/again', [
            'customer_uid' => $this->customer_uid,
            'merchant_uid' => $this->merchant_uid,
            'amount' => $this->donation_price,
            'name' => $this->donation_subject
        ]);

        $response = json_decode($response);
        if (isset($response->code) && $response->code != 0) {
            return [ "code" => 2, "msg" => $response->message, "data" => false ];
        }

        return [ "code" => 1, "msg" => "success...!", "data" => [
            "customer_uid" => $this->customer_uid,
            "merchant_uid" => $this->merchant_uid,
            "response" => json_encode($response)
        ]];
    }

    public function monthly($task)
    {
        $token = $this->getToken();
        if (isset($token->code) && $token->code != 0) {
            return [ "code" => 99, "msg" => $token->message, "data" => false ];
        }

        $this->token = $token->response->access_token;
        $program = DonationProgram::find($task->program_id);
        $merchant_uid = $task->merchant_uid . "_" . ($task->completed + rand(0, 100)); // 여기도 나중에 바꿔야 할 듯??
        $price = $task->donation_type != "분할납부" ? $task->donation_price : $task->divide_price;

        $req = [
            'customer_uid' => $task->customer_uid,
            'merchant_uid' => $merchant_uid,
            'amount' => $price,
            'name' => $program->subject
        ];


        $response = Http::withHeaders([
            "Authorization" => $this->token
        ])->post('https://api.iamport.kr/subscribe/payments/again', $req);


        $response = json_decode($response);

        $success = false;
        $params = [];

        if (isset($response->code) && $response->code == 0)
        {
            $success = true;
            $params = [
                "payment_id" => $task->payments_id,
                "status" => 1,
                "returnValue" => json_encode($response)
            ];
        }
        else
        {
            $params = [
                "payment_id" => $task->payments_id,
                "status" => 2,
                "returnValue" => json_encode($response)
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

    public function divide()
    {
        return $this->once();
    }


}
