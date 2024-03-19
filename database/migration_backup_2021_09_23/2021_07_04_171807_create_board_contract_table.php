<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_contract', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("category")->default("협약서")->comment("분류");
            $table->string("code")->comment("코드(사용안함)")->nullable();
            $table->string("title")->comment("제목");
            $table->string("subtitle")->comment("소제목")->nullable();
            $table->string("writer")->comment("글쓴이")->nullable();
            $table->longText("contents")->comment("내용")->nullable();
            $table->string("editor_image")->comment("에디터 업로드 이미지")->nullable();
            $table->integer("attachment1")->comment("첨부파일1")->nullable();
            $table->integer("attachment2")->comment("첨부파일2")->nullable();
            $table->integer("attachment3")->comment("첨부파일3")->nullable();
            $table->integer("attachment4")->comment("첨부파일4")->nullable();
            $table->integer("thumbnail")->comment("썸네일")->nullable();
            $table->dateTime("from_date")->comment("시작일자")->nullable();
            $table->dateTime("to_date")->comment("종료일자")->nullable();
            $table->string("space1")->comment("체결번호")->nullable();
            $table->string("space2")->comment("상대기관")->nullable();
            $table->string("space3")->comment("주관부서")->nullable();
            $table->string("space4")->comment("여유공간4")->nullable();
            $table->string("space5")->comment("여유공간5")->nullable();
            $table->string("space6")->comment("여유공간6")->nullable();
            $table->string("space7")->comment("여유공간7")->nullable();
            $table->string("space8")->comment("여유공간8")->nullable();
            $table->string("space9")->comment("여유공간9")->nullable();
            $table->string("space10")->comment("여유공간10")->nullable();

            $table->integer("like")->comment("좋아요")->default(0)->nullable();
            $table->integer("bad")->comment("싫어요")->default(0)->nullable();

            $table->integer("hits")->comment("조회수")->default(0)->nullable();
            $table->string("last_ip")->comment("마지막 조회 아이피")->nullable();
            $table->tinyInteger("hidden")->comment("0:보임, 1:숨김")->nullable()->default(0);
            $table->tinyInteger("is_notice")->comment("공지글인지 체크")->nullable()->default(0);

            $table->integer("custom_order")->comment("커스텀정렬값")->nullable()->default(0);
            $table->string("custom_url")->comment("커스텀주소값")->nullable();

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
        Schema::dropIfExists('board_contract');
    }
}
