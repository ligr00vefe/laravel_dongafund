<?php


namespace App\Uploads;


use Illuminate\Http\Request;

class NoticeEditor extends EDITOR
{
    protected $from = "기부소식 에디터 사진 업로드";

    public function run(Request $request)
    {
        return $this->upload($request);
    }
}
