<?php


namespace App\Uploads;


use Illuminate\Http\Request;

class DonateEditor extends EDITOR
{
    protected $from = "기부 프로그램 관리 에디터 사진 업로드";

    public function run (Request $request)
    {
        return $this->upload($request);
    }
}
