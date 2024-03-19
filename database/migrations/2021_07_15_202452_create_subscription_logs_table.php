<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("payment_id")->constrained("payments")->cascadeOnDelete();
            $table->string("status")->comment("성공여부 1:성공, 2:실패");
            $table->text("returnValue")->comment("리턴값들 json_encode저장")->nullable();
            $table->text("comment")->nullable()->comment("특이사항");
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
        Schema::dropIfExists('subscription_logs');
    }
}
