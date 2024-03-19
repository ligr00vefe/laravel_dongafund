<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId("donation_id")->constrained("donations");
            $table->tinyInteger("contract_status")->default(0)->comment("약정상태 0:약정보완, 1:약정완료. 웹은 무조건 완료부터 시작이라고 들었다");
            $table->tinyInteger("send_status")->default(0)->comment("0:전송대기, 1:전송완료, 2:전송불가, 3:연동보류");
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
        Schema::dropIfExists('contract_status');
    }
}
