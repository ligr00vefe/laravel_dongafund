<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("donation_id")->constrained("donations")->cascadeOnDelete();
            $table->string("customer_uid")->nullable()->comment("(아임포트)결제요청할때 빌링키와 상호작용하는 키");
            $table->string("merchant_uid")->nullable()->comment("(아임포트,카카오페이)상품주문번호");
            $table->string("partner_user_id")->nullable()->comment("(카카오페이) 익명일때 랜덤생성되고 sid키 받을떄 또 같은 user_id 사용해야하므로 저장");
            $table->string("kakao_tid")->nullable()->comment("(카카오페이) 결제성공 TID");
            $table->string("kakao_sid")->nullable()->comment("(카카오페이) 정기결제 SID");
            $table->integer("completed")->comment("완료횟수");
            $table->integer("remaining")->comment("남은횟수");
            $table->tinyInteger("result")->comment("0:첫결제실패 1:첫결제성공 2:정기,분할 완전종료")->default(0);
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
        Schema::dropIfExists('payments');
    }
}
