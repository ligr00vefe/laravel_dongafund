<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_donations', function (Blueprint $table) {
            $table->id();
            $table->integer("program_id");
            $table->string("kiosk_url")->comment("키오스크 반환 url");
            $table->string("contract_code")->comment("약정서번호");
            $table->string("donation_type", "30")->comment("기부유형");
            $table->string("donation_price")->comment("기부금액(숫자만 넣기)");
            $table->integer("divide_count")->comment("분할납부 분할횟수")->nullable();
            $table->integer("divide_price")->comment("분할납부 월 기부금액")->nullable();
            $table->string("donator_type")->comment("기부자 정보");
            $table->string("name")->comment("기부자 성명/법인명")->nullable();
            $table->string("tel")->comment("기부자 전화번호")->nullable();
            $table->string("regNumber")->comment("기부자 주민번호/사업자번호")->nullable();
            $table->string("zipcode")->comment("기부자 우편번호")->nullable();
            $table->string("address1")->comment("기부자 주소")->nullable();
            $table->string("address2")->comment("기부자 상세주소")->nullable();
            $table->string("relationship")->comment("기부자 학교와의 관계")->nullable();
            $table->string("enter_year")->comment("기부자 입학연도")->nullable();
            $table->string("course")->comment("기부자 학과/이수과정")->nullable();
            $table->string("payment_type")->comment("납입방법");
            $table->string("credit_card_number")->comment("납입방법 신용카드일때 카드번호")->nullable();
            $table->string("credit_card_expiration")->comment("납입방법 신용카드일때 유효기간")->nullable();
            $table->integer("automatic_transfer_assign_day")->comment("납입방법 자동이체일때 매월 지정일")->nullable();
            $table->string("automatic_bank_name")->comment("납입방법 자동이체일때 은행명")->nullable();
            $table->string("automatic_bank_number")->comment("납입방법 자동이체일때 계좌번호")->nullable();

            $table->tinyInteger("receipt_check")->comment("기부자 영수증 발급용도")->nullable();
            $table->tinyInteger("benefit_check")->comment("기부자 예우혜택 제공 용도")->nullable();
            $table->tinyInteger("tax_check")->comment("세제혜택 편의 제공, 기부금 결제")->nullable();

            $table->tinyInteger("signature_type")->comment("전자서명 유형(1:카카오페이, 2:일반 전자서명)")->nullable();
            $table->tinyInteger("signature_pass")->comment("전자서명 카카오페이일때 성공했는지 1:성공, 2:실패")->nullable();
            $table->bigInteger("signature_save_id")->comment("전자서명 일반 전자서명일때 서명 첨부파일 id")->nullable();

            $table->tinyInteger("payment_status")->comment("결제상태 0:약정서만작성, 1:사인실패, 2:사인성공결제실패, 3:결제성공")->default(0);
            $table->string("ip")->comment("ip")->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kiosk_donations');
    }
}
