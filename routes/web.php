<?php

use App\Models\ViewDonationsAndPayments;
use App\Payments\IamPort;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\FundInfoController;
use App\Http\Controllers\FundIntroController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ETCPaymentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FameController;
use App\Http\Controllers\HonorController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ServiceSelectorController;
use App\Http\Controllers\FundTypeController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SignatureSelfMadeController;
use App\Http\Controllers\DonationCompleteController;
use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\MailNumberController;
use App\Http\Controllers\MailAddressChangeController;
use App\Http\Controllers\AuthChangeController;
use App\Http\Controllers\LoginController;
use App\Http\Async\AsyncSupport;
use App\Http\Controllers\ESignController;
use App\Http\Controllers\KakaocertController;
use App\Http\Async\SignaturePad;
use App\Http\Controllers\KioskDonatePayment;
use App\Http\Controllers\PeriodicalsController;
use App\Http\Async\AsyncPeriodicals;
use App\Http\Async\AsyncNotice;
use App\api\Security;
use App\Payments\KakaoPay;
use App\Payments\Popbill;
use App\Http\Controllers\KakaoVerifyAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 메인
Route::get('/', [ MainController::class, "index" ])->name("main");

// 기부 페이지
Route::resource("/program", ProgramController::class);


Route::prefix("fund")->group(function () {
    // 기부 소개페이지 (헤더에 오렌지색 기부하기 버튼링크)
//    Route::resource("/info", FundInfoController::class);

    // 기부 소개페이지 (헤더에 오렌지색 기부하기 버튼링크)
    Route::resource("/intro", FundIntroController::class);

    // 기부유형 -> 기타기부 (사용안하게 됨).
//    Route::resource("/etc", ETCPaymentController::class);

    // 기부유형 -> 전체
    Route::resource("/type", FundTypeController::class);
});

// 기부프로그램->게시판들
Route::resource("/support", SupportController::class);


// 기부자 라운지 -> 기부소식 게시판
Route::resource("/news", NewsController::class);


// 기부자 라운지 -> 명예의전당
Route::resource("/fame", FameController::class);

// 기부자 라운지 -> 기부자 예우
Route::resource("/honor", HonorController::class);

// 기부자 라운지 -> 기부내역 조회
Route::resource("/history", HistoryController::class);

// 기부자 라운지 -> 기부금 영수증 발급
Route::resource("/receipt", ReceiptController::class);

//// 기부자 라운지 -> 연차보고서
//Route::resource("/annual/report", AnnualController::class)->names([
//    "index" => "annual.report.index",
//    "show" => "annual.report.show"
//]);


// 기부자 라운지 -> 정기간행물
Route::resource("/periodicals", PeriodicalsController::class);

// 기부자 라운지 -> 모금현황
Route::resource("/status", StatusController::class);





// 하단메뉴 -> 세제혜택
Route::resource("/benefit", BenefitController::class);

// 상단헤더 -> 후원의집
Route::resource("/sponsors", SponsorController::class);

// 상단헤더 -> 협력체결 기관
Route::resource("/partners", PartnerController::class);



// 주소 변경
Route::resource("/address", AddressController::class);

// 정보수정
Route::resource("/account", AccountController::class);

// 서비스선택
Route::resource("/service/selector", ServiceSelectorController::class);



Route::prefix("donate")->group(function () {

    // 약정서 (변경)
    Route::resource("/", DonateController::class)->names([
        "index" => "donate.index",
        "store" => "donate.store"
    ])->only([
        "index", "store"
    ]);

    // 결제완료 페이지
    Route::resource("/complete", DonationCompleteController::class)->only([
        "index"
    ])->names([
        "index" => "donate.complete.index",
    ]);

    // 카카오페이 일시기부일때 완료 처리
    Route::get("/kakaopay/complete", [ KakaoPay::class, "complete" ])->name("donate.kakaopay.complete");

    // 카카오페이 정기결제 첫 회 결제 시 sid 발급받는 경로
    Route::get("/kakaopay/getSid", [ KakaoPay::class, "getSid" ])->name("donate.kakaopay.getSid");

    Route::post("/popbill/check", [ Popbill::class, "check" ])->name("donate.popbill.check");

});


// 서명하기 페이지
Route::prefix("signature")->group(function () {

    // 서명하기 메인
    Route::resource("/", SignatureController::class)->names([
        "index" => "signature.index",
        "store" => "signature.store"
    ])->only([
        "index", "store"
    ]);

    // 서명하기 일반
    Route::resource("/self", SignatureSelfMadeController::class);

});



// 본인인증 페이지
Route::prefix("auth")->group(function () {

    // 로그인
    Route::resource("/login", LoginController::class)->names([
        "index" => "login.index",
        "store" => "login.store"
    ])->only([
        "index", "store"
    ]);

    // 로그아웃
    Route::get("/logout", [ LoginController::class, "logout" ])->name("logout");

    // 서명하기 메인
    Route::resource("/check", AuthCheckController::class)->names([
        "index" => "auth.check.index",
        "store" => "auth.check.store",
    ])->only([
        "index", "store"
    ]);

    Route::resource("/change", AuthChangeController::class)->names([
        "index" => "auth.change.index"
    ])->only([
        "index"
    ]);

});


// 우편물관련
Route::prefix("mail")->group(function () {

    // 서명하기 메인
    Route::resource("/number", MailNumberController::class)->names([
        "index" => "mail.number.index",
        "show" => "mail.number.show",
        "store" => "mail.number.store",
    ])->only([
        "index", "store", "show"
    ]);

    // 주소상태 변경
    Route::resource("/address", MailAddressChangeController::class)->names([
        "index" => "mail.address.index",
        "show" => "mail.address.show",
        "store" => "mail.address.store",
    ])->only([
        "index", "store", "show"
    ]);

});






/* 비동기 관련 */
Route::prefix("async")->group(function () {

    // 뉴스 더보기, 정기 간행물 더보기
    Route::get("/support/more", [ AsyncSupport::class, "load" ])->name("async.support.more");
    Route::get("/news/more", [ AsyncNotice::class, "more" ])->name("async.news.more");
    Route::get("/periodicals/more", [ AsyncPeriodicals::class, "more"])->name("async.periodicals.more");

    // 카카오 전자서명 요청하기
    Route::post("/kakao/cert/request", [ KakaocertController::class, "requestESign" ])->name("async.kakao.cert.request");
    Route::post("/kakao/cert/state", [ KakaocertController::class, "GetESignState" ])->name("async.kakao.cert.state");
    Route::post("/kakao/cert/verify", [ KakaocertController::class, "VerifyESign" ])->name("async.kakao.cert.verify");

    // 카카오 본인인증 요청하기
    Route::post("/kakao/auth/request", [ KakaocertController::class, "RequestVerifyAuth" ])->name("async.kakao.auth.request");
    Route::post("/kakao/auth/state", [ KakaocertController::class, "GetVerifyAuthState" ])->name("async.kakao.auth.state");
    Route::post("/kakao/auth/verify", [ KakaocertController::class, "VerifyAuth" ])->name("async.kakao.auth.verify");

    // 일반 전자서명 저장하기
   Route::post("/signature/save", [ SignaturePad::class, "save" ])->name("async.signature.save");

   // 약정서 작성 비동기로
   Route::post("/donate/add", [ DonateController::class, "store" ])->name("async.donate.add");

});


Route::get("/kiosk/donate", [ KioskDonatePayment::class, "index" ]);
Route::post("/kiosk/donate", [ KioskDonatePayment::class, "store" ]);


/* 카카오페이 전자서명 관련 */
Route::get('/RequestESign', [ ESignController::class, "RequestESign" ]);


//Route::get("/bri/payment", function () {
//
//    $unfinished = ViewDonationsAndPayments::unfinished(25);
//    pp($unfinished);
//
//    foreach ($unfinished as $key => $value)
//    {
//
//        switch ($value->payment_type)
//        {
//            case "신용카드":
//                $payment = new IamPort();
//                $payment->monthly($value);
//                break;
//            case "카카오페이":
//                $payment = new KakaoPay();
//                $payment->monthly($value);
//                break;
//        }
//
//    }
//});
//Route::post("/bri/payment/result", [ \App\Http\Controllers\TestPaymentController::class, "result" ]);


//Route::get("/bri/enc", [ Security::class, "encrypt" ]);

//Route::get("/bri/iamsubs", [ \App\Payments\IamPort::class, "monthly" ]);
//Route::get("/bri/kakaosubs", [ KakaoPay::class, "monthly" ]);
