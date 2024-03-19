<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_payments', function (Blueprint $table) {
            $table->id();
            $table->integer("program_id")->nullable()->comment("kiosk_programs 테이블 id. 외래키는 아직까지 안함");
            $table->string("donation_code")->comment("키오스크 도네이션프로그램 구분값");
            $table->tinyInteger("completed")->default(0)->comment("결제완료횟수");
            $table->tinyInteger("remaining")->default(0)->comment("남은횟수");
            $table->tinyInteger("result")->default(0)->comment("미완료:0, 불완전완료:1, 완전완료:2");
            $table->string("url")->comment("url만들기");
            $table->softDeletes();
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
        Schema::dropIfExists('kiosk_payments');
    }
}
