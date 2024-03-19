<?php


namespace App\Console;
use App\Models\ViewDonationsAndPayments;
use App\Payments\IamPort;
use App\Payments\KakaoPay;
use Illuminate\Console\Scheduling\Schedule;

class PaymentConsole
{

    public static function boot($day)
    {
        $unfinished = ViewDonationsAndPayments::unfinished($day);

        foreach ($unfinished as $key => $value)
        {

            switch ($value->payment_type)
            {
                case "신용카드":
                    $payment = new IamPort();
                    $payment->monthly($value);
                    break;
                case "카카오페이":
                    $payment = new KakaoPay();
                    $payment->monthly($value);
                    break;
            }

        }

    }

    public static function run(Schedule $schedule)
    {
        /* 매달 10일 13:00분에 정기기부, 분할납부 실행하기 */
        $schedule->call(function () {
            self::boot(10);
        })
            ->monthlyOn(10, "13:00");
//            ->everyMinute();


        /* 매달 25일 13:00분에 정기기부, 분할납부 실행하기 */
        $schedule->call(function () {
            self::boot(25);
        })
            ->monthlyOn(25, "13:00");
//            ->everyMinute();
    }

}
