<?php

namespace App\Http\Controllers;

use App\Models\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Linkhub\Kakaocert\KakaocertException;
use Linkhub\Kakaocert\KakaocertService;

class AuthCheckController extends Controller
{
    public $KakaocertService;
    private $clientCode = "021060000001";

    public function __construct()
    {
        // 통신방식 설정
        define('LINKHUB_COMM_MODE', config('kakaocert.LINKHUB_COMM_MODE'));
        if (!defined("LINKHUB_COMM_MODE")) {
        }

        // kakaocert 서비스 클래스 초기화
        $this->KakaocertService = new KakaocertService(config('kakaocert.LinkID'), config('kakaocert.SecretKey'));

        // 인증토큰의 IP제한기능 사용여부, 권장(true)
        $this->KakaocertService->IPRestrictOnOff(config('kakaocert.IPRestrictOnOff'));
    }

    public function index(Request $request)
    {
        $return = $request->input("return") ?? false;
        return view("auth.check.index", [
            "return" => $return
        ]);
    }

    public function store(Request $request)
    {
        $clientCode = $this->clientCode;

        // 본인인증 요청시 반환받은 접수아이디
        $receiptID = $request->input("receiptID");

        try {
            $result = $this->KakaocertService->verifyAuth($clientCode, $receiptID);
        }
        catch(KakaocertException $ke) {
            $code = $ke->getCode();
            $message = $ke->getMessage();
//            return back()->with("error", "본인인증에 실패했습니다. 다시 시도해 주세요 code:" . $code . " ". $message);
        }

        $add = Authenticate::add([
            "name" => $request->input("name") ?? "",
            "tel" => $request->input("tel") ?? "",
            "birth" => $request->input("birth") ?? "",
            "receiptID" => $request->input("receiptID") ?? "",
            "signedData" => $result->signedData ?? "TEST"
        ]);


        if ($add)
        {
//            return redirect($request->input("return"))->withCookie("auth_token", $add->token, 120);
            return redirect("/")->with("error", "서비스 준비중입니다");
        }
        else
        {
            return back()->with("error", "저장에 실패했습니다. 다시 시도해 주세요");
        }
    }
}
