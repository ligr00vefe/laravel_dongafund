<?php


namespace App\Http\Async;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SignaturePad
{

    public function save(Request $request)
    {
        $folderPath = public_path('/storage/uploads/signature/');
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0775);
        }

        $image_parts = explode(";base64,", $request->input("params"));

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = date("YmdHis") . uniqid() . '.'.$image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $attachment_id = DB::table("attachments")
            ->insertGetId([
                "user_id" => Auth::id() ?? 1,
                "from" => "일반 전자서명",
                "original_name" => $fileName,
                "path" => $file,
            ]);


        return response()->json([
            "path" => $folderPath,
            "fileName" => $fileName,
            "id" => $attachment_id
        ]);

    }

}
