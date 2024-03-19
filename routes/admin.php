<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminDonationProgramManagementController;
use App\Http\Controllers\AdminPrivacyAgreementController;
use App\Http\Controllers\AdminPrivacyInquireController;
use App\Http\Controllers\AdminAuthorityController;
use App\Http\Controllers\AdminDonateProgramController;
use App\Http\Controllers\AdminNewsManagementController;
use App\Http\Controllers\AdminContractManagementController;
use App\Http\Controllers\AdminPeriodicalsManagementController;
use App\Uploads\AdminUpload;
use App\Uploads\DonateEditor;
use App\Uploads\NoticeEditor;
use App\Http\Controllers\AdminDonateContractController;
use App\Http\Controllers\AdminDonateExcelContractController;
use App\Http\Controllers\AdminDonateSendingContractController;
use App\Http\Controllers\AdminExcelExportController;
use App\Http\Controllers\AdminDonatePaymentController;
use App\Http\Controllers\AdminLogAuthController;
use App\Http\Controllers\AdminPrivacyInquireExcelController;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
*/


/*
 * 관리자 페이지 라우팅
 * : 동아대 공문 내용 중 관리자 페이지를 특정할 수 있는 주소(adm, admin, manage) 사용 금지 내용 있음.
 *   관리자 페이지 /b1BjW55p 로 통일
 */

$adminUrl = "b1BjW55p";



Route::prefix("{$adminUrl}/donate")->group(function () {

    Route::post("/program/update", [ AdminDonateProgramController::class, "s_update" ])->name("admin.donate.program.select.update");
    Route::post("/program/s_destroy", [ AdminDonateProgramController::class, "s_destroy" ])->name("admin.donate.program.select.destroy");

    // 관리자 기부 프로그램 관리
    Route::resource("/program", AdminDonateProgramController::class)->names([
        "index" => "admin.donate.program.index",
        "show" => "admin.donate.program.show",
        "create" => "admin.donate.program.create",
        "store" => "admin.donate.program.store",
        "edit" => "admin.donate.program.edit",
        "update" => "admin.donate.program.update",
        "destroy" => "admin.donate.program.destroy",
    ])->parameters([
        "program" => "id"
    ]);

    Route::resource("/contract", AdminDonateContractController::class)->names([
        "index" => "admin.donate.contract.index",
        "show" => "admin.donate.contract.show",
        "create" => "admin.donate.contract.create",
        "store" => "admin.donate.contract.store",
        "edit" => "admin.donate.contract.edit",
        "update" => "admin.donate.contract.update",
        "destroy" => "admin.donate.contract.destroy"
    ]);

    Route::resource("/excel/contract", AdminDonateExcelContractController::class)->names([
        "index" => "admin.donate.excel.contract"
    ])->only([
        "index"
    ]);

    // 약정서 보내기 페이지
    Route::resource("/sending/contract", AdminDonateSendingContractController::class)->names([
        "index" => "admin.donate.sending.contract.index",
        "show" => "admin.donate.sending.contract.show",
        "create" => "admin.donate.sending.contract.create",
        "store" => "admin.donate.sending.contract.store",
        "edit" => "admin.donate.sending.contract.edit",
        "update" => "admin.donate.sending.contract.update",
        "destroy" => "admin.donate.sending.contract.destroy",
    ]);



    // 결제/승인 내역
    Route::resource("/payment", AdminDonatePaymentController::class)->names([
        "index" => "admin.donate.payment.index",
        "show" => "admin.donate.payment.show",
        "create" => "admin.donate.payment.create",
        "store" => "admin.donate.payment.store",
        "edit" => "admin.donate.payment.edit",
        "update" => "admin.donate.payment.update",
        "destroy" => "admin.donate.payment.destroy",
    ]);

});





// 관리자 개인정보 관리
Route::prefix("{$adminUrl}/privacy")->group(function () {

    // 관리자 개인정보 동의 내역
    Route::resource("/agreement", AdminPrivacyAgreementController::class)->names([
        "index" => "admin.privacy.agreement.index",
        "show" => "admin.privacy.agreement.show",
        "create" => "admin.privacy.agreement.create",
        "store" => "admin.privacy.agreement.store",
        "edit" => "admin.privacy.agreement.edit",
        "update" => "admin.privacy.agreement.update",
        "destroy" => "admin.privacy.agreement.destroy",
    ]);

    // 관리자 개인정보 조회 내역
    Route::resource("/inquire", AdminPrivacyInquireController::class)->names([
        "index" => "admin.inquire.agreement.index",
        "show" => "admin.inquire.agreement.show",
        "create" => "admin.inquire.agreement.create",
        "store" => "admin.inquire.agreement.store",
        "edit" => "admin.inquire.agreement.edit",
        "update" => "admin.inquire.agreement.update",
        "destroy" => "admin.inquire.agreement.destroy",
    ]);

});


Route::delete("/{$adminUrl}/auth/delete", [ AdminAuthorityController::class, "delete" ])->name("admin.auth.delete");

// 관리자 권한 관리
Route::resource("/{$adminUrl}/auth", AdminAuthorityController::class)->names([
    "index" => "admin.auth.index",
    "show" => "admin.auth.show",
    "create" => "admin.auth.create",
    "store" => "admin.auth.store",
    "edit" => "admin.auth.edit",
    "update" => "admin.auth.update",
    "destroy" => "admin.auth.destroy",
]);


// 관리자 개인정보 관리
Route::prefix("{$adminUrl}/contents")->group(function () {

    // 관리자 컨텐츠관리 기부소식
    Route::resource("/news", AdminNewsManagementController::class)->names([
        "index" => "admin.contents.news.index",
        "show" => "admin.contents.news.show",
        "create" => "admin.contents.news.create",
        "store" => "admin.contents.news.store",
        "edit" => "admin.contents.news.edit",
        "update" => "admin.contents.news.update",
        "destroy" => "admin.contents.news.destroy",
    ])->parameters([
        "news" => "id"
    ]);

    // 관리자 컨텐츠관리 간행물
    Route::resource("/periodicals", AdminPeriodicalsManagementController::class)->names([
        "index" => "admin.contents.periodicals.index",
        "show" => "admin.contents.periodicals.show",
        "create" => "admin.contents.periodicals.create",
        "store" => "admin.contents.periodicals.store",
        "edit" => "admin.contents.periodicals.edit",
        "update" => "admin.contents.periodicals.update",
        "destroy" => "admin.contents.periodicals.destroy",
    ])->parameters([
        "periodicals" => "id"
    ]);;

    // 관리자 협약서
    Route::resource("/contract", AdminContractManagementController::class)->names([
        "index" => "admin.contents.contract.index",
        "show" => "admin.contents.contract.show",
        "create" => "admin.contents.contract.create",
        "store" => "admin.contents.contract.store",
        "edit" => "admin.contents.contract.edit",
        "update" => "admin.contents.contract.update",
        "destroy" => "admin.contents.contract.destroy",
    ])->parameters([
        "contract" => "id"
    ]);

});


Route::prefix("{$adminUrl}/log")->group(function () {

    Route::resource("/auth", AdminLogAuthController::class)->names([
        "index" => "admin.log.auth.index",
        "show" => "admin.log.auth.show",
        "create" => "admin.log.auth.create",
        "store" => "admin.log.auth.store",
        "edit" => "admin.log.auth.edit",
        "update" => "admin.log.auth.update",
        "destroy" => "admin.log.auth.destroy",
    ]);

});


Route::prefix("{$adminUrl}/upload")->group(function () {

    Route::post("/editor/donate", [ DonateEditor::class, "run" ])->name("admin.upload.editor.donate");
    Route::post("/editor/news", [ NoticeEditor::class, "run" ])->name("admin.upload.editor.news");

});


Route::prefix("{$adminUrl}/excel")->group(function () {

    Route::post("/export/contract", [ AdminExcelExportController::class, "contract" ])->name("admin.excel.export.contract");
    Route::post("/export/log/adminPermission", [ AdminExcelExportController::class, "adminPermissionLogs" ])
        ->name("admin.excel.export.log.adminPermission");

    Route::post("/export/payment", [ AdminExcelExportController::class, "payment" ])->name("admin.excel.export.payment");


    Route::get("/export/privacy/inquire", [ AdminPrivacyInquireExcelController::class, "index" ])->name("admin.excel.export.privacy.index");
    Route::post("/export/privacy/inquire", [ AdminExcelExportController::class, "privacy" ])->name("admin.excel.export.privacy.download");
    Route::post("/export/privacy/agreement", [ AdminExcelExportController::class, "agreement" ])->name("admin.excel.export.agreement.download");


});


//Route::prefix("address")->group(function () {
//    Route::resource("/input", [ AddressController::class ]);
//});
