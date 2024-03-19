<?php


namespace App\Uploads;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ATTACHMENT
{
    protected $files;
    protected $filenames;
    protected $uploadPath;
    protected $from;
    protected $exts = [];


    public function upload(Request $request)
    {

        $user_id = Auth::id() ?? 1;
        $files = $request->file();

        $data = [
            "success" => [],
            "fail" => [],
        ];


        foreach ($files as $key => $file)
        {
            if(!$request->hasFile($key)) {
                $data['fail'][] = [
                    "msg" => "파일이 없습니다",
                    "file" => $file
                ];
                continue;
            }

            $originName = $request->file($key)->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file($key)->getClientOriginalExtension();

            if (!empty($this->exts) && !in_array(strtolower($extension), $this->exts)) {
                return false;
//                $data['fail'][] = [
//                    "file" => $originName,
//                    "msg" => "사용할 수 없는 확장자명입니다",
//                ];
                continue;
            }

            $encrypted_fileName = bin2hex(random_bytes(20)).'_'.time().'.'.$extension;

            $path = $request->file($key)->storeAs("/uploads/attachment/" . $this->uploadPath ?? "default" . "/" , $encrypted_fileName, "public");

            $attachment = DB::table("attachments")
                ->insertGetId([
                    "user_id" => $user_id,
                    "from" => $this->from ?? "",
                    "original_name" => $originName,
                    "path" => $path,
                ]);

            $url = asset('/storage/uploads/attachment/'.$encrypted_fileName);
            $msg = 'Image uploaded successfully';

            $data['success'][$key] = [
                "id" => $attachment,
                "url" => $url,
                "msg" => $msg
            ];

        }

        return $data;
    }
}
