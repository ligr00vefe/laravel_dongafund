<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permission', function (Blueprint $table) {
            $table->id();
//            $table->foreignId("user_id")->constrained("users");
            $table->string("account_id")->comment("동아대 SSO 계정(미리 등록해놓고 나중에 SSO 연동하는 방식)");
            $table->string("permissions")->nullable()->comment("권한이 콤마(,) 한글 형태로 들어감");
            $table->string("ip")->nullable()->comment("접속IP");
            $table->date("expire_date")->nullable()->comment("권한만료일");
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
        Schema::dropIfExists('admin_permission');
    }
}
