<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authenticate', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("tel");
            $table->string("birth");
            $table->string("receiptID")->nullable()->comment("[카카오 인증] receiptID");
            $table->string("signedData")->nullable()->comment("[카카오 인증] signedData(증명용)");
            $table->string("etc")->nullable()->comment("비고");
            $table->string("token")->nullable()->comment("한번 본인인증으로 여러군데 사용해야할 지 모르니 토큰을 저장한다");
            $table->dateTime("available_at")->nullable()->comment("토큰유효시간");
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
        Schema::dropIfExists('authenticate');
    }
}
