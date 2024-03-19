<?php


namespace App\Uploads;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EDITOR
{
    protected $from;

    public function upload(Request $request)
    {

        $user_id = Auth::id() ?? 1;

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $encrypted_fileName = bin2hex(random_bytes(20)).'_'.time().'.'.$extension;

            $path = $request->file("upload")->storeAs("/uploads/attachment", $encrypted_fileName, "public");

//            $origin = $_SERVER['HTTP_ORIGIN'];
//            $REFERER = str_ireplace($origin, "", $_SERVER['HTTP_REFERER']);
//            $board_name = "board_" . explode("/", $REFERER)[0] . "_img";

            $attachment = DB::table("attachments")
                ->insertGetId([
                    "user_id" => $user_id,
                    "from" => $this->from ?? "",
                    "original_name" => $originName,
                    "path" => $path,
                ]);

            $url = asset('/storage/uploads/attachment/'.$encrypted_fileName);
            $msg = 'Image uploaded successfully';

            return response()->json([
                "data"=> "data",
                "url" => $url,
                "msg" => $msg,
                "id" => $attachment
            ]);
        }
    }
}
