<?php


namespace App\Uploads;


class NewsAttachment extends ATTACHMENT
{
    protected $filenames = [ "thumbnail" ];
    protected $from = "기부소식";
    protected $uploadPath = "news";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif" ];

    public function set($request)
    {
        if (!$request->file()) return false;

        $upload = $this->execute($request);
        if (!$upload) {
            return back()->with("error", "잘못된 접근입니다");
        }

        $thumbnail = $upload['success']['thumbnail']['id'] ?? false;

        $return = [];

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
