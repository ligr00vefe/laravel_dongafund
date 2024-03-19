<?php


namespace App\Uploads;


class DonateAttachment extends ATTACHMENT
{
    protected $filenames = [ "icon", "thumbnail" ];
    protected $from = "기부 프로그램 관리";
    protected $uploadPath = "donate";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif" ];

    public function set($request)
    {
        if (!$request->file()) return false;

        $upload = $this->execute($request);
        if (!$upload) {
            return back()->with("error", "잘못된 접근입니다");
        }

        $icon = $upload['success']['icon']['id'] ?? false;
        $thumbnail = $upload['success']['thumbnail']['id'] ?? false;

        $return = [];
        if ($icon) {
            $return["icon"] = $icon;
        }
        if ($thumbnail) {
            $return["thumbnail"] = $thumbnail;
        }

        return $return;
    }


    public function execute($request)
    {
        return $this->upload($request);
    }

}
