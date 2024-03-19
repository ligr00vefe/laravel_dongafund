<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Linkhub\LinkhubException;
use Linkhub\Kakaocert\KakaocertException;
use Linkhub\Kakaocert\KakaocertService;
use Linkhub\Kakaocert\RequestESign;
use Linkhub\Kakaocert\ResultESign;
use Linkhub\Kakaocert\RequestVerifyAuth;
use Linkhub\Kakaocert\ResultVerifyAuth;
use Linkhub\Kakaocert\RequestCMS;
use Linkhub\Kakaocert\ResultCMS;

class KakaoVerifyAuthController
{
    public function __construct() {

        // 통신방식 설정
        define('LINKHUB_COMM_MODE', config('kakaocert.LINKHUB_COMM_MODE'));

        // kakaoCert 서비스 클래스 초기화
        $this->KakaocertService = new KakaocertService(config('kakaocert.LinkID'), config('kakaocert.SecretKey'));

        // 인증토큰의 IP제한기능 사용여부, 권장(true)
        $this->KakaocertService->IPRestrictOnOff(config('kakaocert.IPRestrictOnOff'));
    }

    /*
    * 본인인증을 요청합니다.
    * - 본인인증 서비스에서 이용기관이 생성하는 Token은 사용자가 전자서명할 원문이 됩니다. 이는 보안을 위해 1회용으로 생성해야 합니다.
    * - 사용자는 이용기관이 생성한 1회용 토큰을 서명하고, 이용기관은 그 서명값을 검증함으로써 사용자에 대한 인증의 역할을 수행하게 됩니다.
    */
    public function RequestVerifyAuth(Request $request) {

        // Kakaocert 이용기관코드, Kakaocert 파트너 사이트에서 확인
        $clientCode = '021060000001';

        // 본인인증 요청정보 객체
        $RequestVerifyAuth = new RequestVerifyAuth();

        // 고객센터 전화번호, 카카오톡 인증메시지 중 "고객센터" 항목에 표시
        $RequestVerifyAuth->CallCenterNum = '1600-9999';

        // 인증요청 만료시간(초), 최대값 : 1000  인증요청 만료시간(초) 내에 미인증시, 만료 상태로 처리됨 (권장 : 300)
        $RequestVerifyAuth->Expires_in = 300;

        // 수신자 생년월일, 형식 : YYYYMMDD
        $RequestVerifyAuth->ReceiverBirthDay = $request->input("birth");

        // 수신자 휴대폰번호
        $RequestVerifyAuth->ReceiverHP = $request->input("tel");

        // 수신자 성명
        $RequestVerifyAuth->ReceiverName = $request->input("name");

        // 별칭코드, 이용기관이 생성한 별칭코드 (파트너 사이트에서 확인가능)
        // 카카오톡 인증메시지 중 "요청기관" 항목에 표시
        // 별칭코드 미 기재시 이용기관의 이용기관명이 "요청기관" 항목에 표시
        $RequestVerifyAuth->SubClientID = '';

        // 인증요청 메시지 부가내용, 카카오톡 인증메시지 중 상단에 표시
        $RequestVerifyAuth->TMSMessage = 'TMSMessage';

        // 인증요청 메시지 제목, 카카오톡 인증메시지 중 "요청구분" 항목에 표시
        $RequestVerifyAuth->TMSTitle = 'TMSTitle';

        // 토큰 원문
        $RequestVerifyAuth->Token = "TMS Token";

        // 인증서 발급유형 선택
        // true : 휴대폰 본인인증만을 이용해 인증서 발급
        // false : 본인계좌 점유 인증을 이용해 인증서 발급
        // 카카오톡 인증메시지를 수신한 사용자가 카카오인증 비회원일 경우, 카카오인증 회원등록 절차를 거쳐 은행계좌 실명확인 절차를 밟은 다음 전자서명 가능
        $RequestVerifyAuth->isAllowSimpleRegistYN = false;

        // 수신자 실명확인 여부
        // true : 카카오페이가 본인인증을 통해 확보한 사용자 실명과 ReceiverName 값을 비교
        // false : 카카오페이가 본인인증을 통해 확보한 사용자 실명과 RecevierName 값을 비교하지 않음.
        $RequestVerifyAuth->isVerifyNameYN = true;

        // PayLoad, 이용기관이 생성한 payload(메모) 값
        $RequestVerifyAuth->PayLoad = 'memo Info';

        try {
            $receiptID = $this->KakaocertService->requestVerifyAuth($clientCode, $RequestVerifyAuth);
        }
        catch(KakaocertException $ke) {
            $code = $ke->getCode();
            $message = $ke->getMessage();
            return response()->json([
                "code" => $code, "message" => $message, "value" => "error"
            ]);
        }

        return response()->json([
            "code" => 1, "message" => "success!", "value" => $receiptID
        ]);
    }
}
