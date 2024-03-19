<?php


namespace App\Payments;

require_once dirname(__FILE__).'/Popbill/PopbillAccountCheck.php';

use Illuminate\Http\Request;
use AccountCheckService;

class Popbill
{

    /*
     *
     * 예금주조회 SDK
     * 약정서에서 자동이체로 결제진행 시 사용자 계좌정보가 맞는지 확인한다
     *
     * */

    private string $LinkID = "DONGAUNIV";
    private string $secretKey = "GvahJgZdlCdOIO4dvojbj7S25/C/cJdjcVZRuU977vs=";
    private string $license = "6038201274";

    public $AccountCheckService;


    public function __construct()
    {
        // 링크아이디
        $LinkID = $this->LinkID;

        // 비밀키
        $SecretKey = $this->secretKey;

        //통신방식 기본은 CURL , curl 사용에 문제가 있을경우 STREAM 사용가능.
        //STREAM 사용시에는 allow_url_fopen = on 으로 설정해야함.
        define('LINKHUB_COMM_MODE','CURL');

        $this->AccountCheckService = new AccountCheckService($LinkID, $SecretKey);

        // 연동환경 설정값, 개발용(true), 상업용(false)
        $this->AccountCheckService->IsTest(true);

        // 인증토큰에 대한 IP제한기능 사용여부, 권장(true)
        $this->AccountCheckService->IPRestrictOnOff(true);

        // 팝빌 API 서비스 고정 IP 사용여부(GA), 기본값(false)
        $this->AccountCheckService->UseStaticIP(false);

        // 로컬시스템 시간 사용 여부 true(기본값) - 사용, false(미사용)
        $this->AccountCheckService->UseLocalTimeYN(true);
    }

    public function check(Request $request)
    {
        // 팝빌회원 사업자번호
        $MemberCorpNum = $this->license;

        // 기관코드
        $BankCode = $this-> convertBankCode($request->input("bankName"));

        // 계좌번호
        $AccountNumber = $request->input("bankNumber");
        $result = $this->AccountCheckService->CheckAccountInfo($MemberCorpNum, $BankCode, $AccountNumber);

        return response()->json($result);
    }


    private function convertBankCode($bank)
    {
        $bankCodes = [
            "산업은행" => "0002", "기업은행" => "0003", "국민은행" => "0004", "수협중앙회" => "0007", "농협은행" => "0011",
            "지역농축협" => "0012", "우리은행" => "0020", "SC은행" => "0023", "한국씨티은행" => "0027", "대구은행" => "0031",
            "부산은행" => "0032", "광주은행" => "0034", "제주은행" => "0035", "전북은행" => "0037", "경남은행" => "0039", "새마을금고연합회" => "0045",
            "신협" => "0048", "저축은행" => "0050", "HSBC은행" => "0054", "도이치은행" => "0055", "JP모간체이스은행" => "0057", "BOA은행" => "0060",
            "BNP파리바은행" => "0061", "중국공상은행" => "0062", "산림조합" => "0064", "중국건설은행" => "0067", "우체국" => "0071", "하나은행" => "0081",
            "신한은행" => "0088", "케이뱅크" => "0089", "카카오뱅크" => "0090"
        ];

        return $bankCodes[$bank];
    }

}
