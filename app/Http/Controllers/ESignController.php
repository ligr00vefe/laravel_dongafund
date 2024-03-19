<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Linkhub\LinkhubException;
use Linkhub\Kakaocert\KakaocertException;
use Linkhub\Kakaocert\KakaocertService;
use Linkhub\Kakaocert\RequestESign;

class ESignController extends Controller
{
    public function __construct() {

        // 통신방식 설정
        define('LINKHUB_COMM_MODE', config('kakaocert.LINKHUB_COMM_MODE'));
        if (!defined("LINKHUB_COMM_MODE")) {
        }

        // kakaoCert 서비스 클래스 초기화
        $this->KakaocertService = new KakaocertService(config('kakaocert.LinkID'), config('kakaocert.SecretKey'));

        // 인증토큰의 IP제한기능 사용여부, 권장(true)
        $this->KakaocertService->IPRestrictOnOff(config('kakaocert.IPRestrictOnOff'));
    }
    /*
    * 전자서명 인증을 요청합니다.
    */
    public function RequestESign(){

        // 전자서명 AppToApp 인증 여부
        // true-App To App 방식, false-Talk Message 방식
        $isAppUseYN = false;

        // Kakaocert 이용기관코드, Kakaocert 파트너 사이트에서 확인
        $clientCode = '021060000001';

        // 전자서명 요청정보 객체
        $RequestESign = new RequestESign();

        // 고객센터 전화번호, 카카오톡 인증메시지 중 "고객센터" 항목에 표시
        $RequestESign->CallCenterNum = '1600-9999';

        // 인증요청 만료시간(초), 최대값 : 1000  인증요청 만료시간(초) 내에 미인증시, 만료 상태로 처리됨 (권장 : 300)
        $RequestESign->Expires_in = 300;

        // 수신자 생년월일, 형식 : YYYYMMDD
        $RequestESign->ReceiverBirthDay = '19911128';

        // 수신자 휴대폰번호
        $RequestESign->ReceiverHP = '01042001778';

        // 수신자 성명
        $RequestESign->ReceiverName = '전승희';

        // 별칭코드, 이용기관이 생성한 별칭코드 (파트너 사이트에서 확인가능)
        // 카카오톡 인증메시지 중 "요청기관" 항목에 표시
        // 별칭코드 미 기재시 이용기관의 이용기관명이 "요청기관" 항목에 표시
        $RequestESign->SubClientID = '';

        // 인증요청 메시지 부가내용, 카카오톡 인증메시지 중 상단에 표시
        $RequestESign->TMSMessage = 'TMSMessage';

        // 인증요청 메시지 제목, 카카오톡 인증메시지 중 "요청구분" 항목에 표시
        $RequestESign->TMSTitle = 'TMSTitle';

        // 전자서명할 토큰 원문
        $RequestESign->Token = "TMS Token ";

        // 인증서 발급유형 선택
        // true : 휴대폰 본인인증만을 이용해 인증서 발급
        // false : 본인계좌 점유 인증을 이용해 인증서 발급
        // 카카오톡 인증메시지를 수신한 사용자가 카카오인증 비회원일 경우, 카카오인증 회원등록 절차를 거쳐 은행계좌 실명확인 절차를 밟은 다음 전자서명 가능
        $RequestESign->isAllowSimpleRegistYN = false;

        // 수신자 실명확인 여부
        // true : 카카오페이가 본인인증을 통해 확보한 사용자 실명과 ReceiverName 값을 비교
        // false : 카카오페이가 본인인증을 통해 확보한 사용자 실명과 RecevierName 값을 비교하지 않음.
        $RequestESign->isVerifyNameYN = true;

        // PayLoad, 이용기관이 생성한 payload(메모) 값
        $RequestESign->PayLoad = 'memo Info';

        try {
            $response = $this->KakaocertService->requestESign($clientCode, $RequestESign, $isAppUseYN);

        }
        catch(KakaocertException | LinkhubException $ke) {
            $code = $ke->getCode();
            $message = $ke->getMessage();
            return view('RequestESign', ['code' => $code, 'message' => $message, 'receiptId' => 'error']);
        }
        return view('RequestESign', ['receiptId' => $response->receiptId, 'tx_id' => $response->tx_id]);
    }
}
