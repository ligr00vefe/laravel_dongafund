<?php


namespace App\Uploads;


class ContractAttachment extends ATTACHMENT
{
    protected $filenames = [ "attachment1", "thumbnail" ];
    protected $from = "협약서";
    protected $uploadPath = "contract";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif" ];

    public function set($request)
    {
        if (!$request->file()) return false;

        $upload = $this->execute($request);
        if (!$upload) {
            return back()->with("error", "잘못된 접근입니다");
        }

        // 아래 부분 변경해주셔야 합니다. $filenames 에
        $attachment1 = $upload['success']['attachment1']['id'] ?? false;
        $thumbnail = $upload['success']['thumbnail']['id'] ?? false;

        $return = [];
        if ($attachment1) {
            $return["attachment1"] = $attachment1;
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
