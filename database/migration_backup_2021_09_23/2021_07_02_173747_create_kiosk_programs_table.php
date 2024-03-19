<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("donation_code")->comment("발전기금 코드")->nullable();
            $table->string("subject")->comment("프로그램명");

            $table->tinyInteger("donation_type1")->comment("기부방식 정기기부")->default(2);
            $table->tinyInteger("donation_type2")->comment("기부방식 일시기부")->default(2);
            $table->tinyInteger("donation_type3")->comment("기부방식 분할납부")->default(2);
            $table->string("payment_method", "30")->comment("납입방법");


            $table->tinyInteger("fixing_check")->comment("기부금액 지정 여부")->default(2);
            $table->string("fixing_price")->comment("지정 기부금액")->nullable();
            $table->string("icon")->comment("아이콘")->nullable();
            $table->string("thumbnail")->comment("대표이미지")->nullable();
            $table->longText("contents")->comment("설명 텍스트");
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
        Schema::dropIfExists('kiosk_programs');
    }
}
