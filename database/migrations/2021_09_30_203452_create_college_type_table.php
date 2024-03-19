<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeTypeTable extends Migration
{
    /**
     * Run the  migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_type', function (Blueprint $table) {
            $table->id();
            $table->string('college')->comment('단과대');
            $table->string("department")->comment("학과");
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
        Schema::dropIfExists('college_type');
    }
}
