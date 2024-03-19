<?php
$mid = $_POST['MID'];							// 상점 아이디
$tid = $_POST['TID'];							// 거래번호
$moid = $_POST['Moid'];							// 상점 주문번호
$amt = $_POST['Amt'];							// 금액
$goodsName = $_POST['GoodsName'];				// 상품명
$cardInterest = $_POST['CardInterest'];			// 무이자 여부
$cardQuota = $_POST['CardQuota'];				// 할부 개월
$charSet = $_POST['CharSet'];					// 응답 파라미터 인코딩 방식
$cardNo = $_POST['CardNo'];						// 카드번호
$cardExpire = $_POST['CardExpire'];				// 유효기간
$buyerAuthNum = $_POST['BuyerAuthNum'];			// 생년월일 / 사업자번호
$cardPwd = $_POST['CardPwd'];						// 카드 비밀번호 앞 2자리
$keyinRequestURL = "https://webapi.nicepay.co.kr/webapi/card_keyin.jsp";

$response ="";

	/*
	*******************************************************
	* <해쉬암호화> (수정하지 마세요)
	* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
	*******************************************************
	*/
	$plainText = "CardNo=".$cardNo."&CardExpire=".$cardExpire."&BuyerAuthNum=".$buyerAuthNum."&CardPwd=".$cardPwd;
	$ediDate = date("YmdHis");
	$merchantKey = "b+zhZ4yOZ7FsH8pm5lhDfHZEb79tIwnjsdA0FBXh86yLc6BJeFVrZFXhAoJ3gEWgrWwN+lJMV0W4hvDdbe4Sjw=="; // 상점키
	$encData = bin2hex(aesEncryptSSL($plainText, substr($merchantKey, 0, 16)));
	$signData = bin2hex(hash('sha256', $mid . $amt . $ediDate . $moid . $merchantKey, true));

	$data = Array(
		'TID' => $tid,
		'MID' => $mid,
		'EdiDate' => $ediDate,
		'Moid' => $moid,
		'Amt' => $amt,
		'GoodsName' => $goodsName,
		'EncData' => $encData,
		'SignData' => $signData,
		'CardInterest' => $cardInterest,
		'CardQuota' => $cardQuota

	);
	$response = reqPost($data, $keyinRequestURL); //승인 호출


jsonRespDump($response); //response json dump example


// AES 암호화 (opnessl)
function aesEncryptSSL($data, $key){
	$iv = openssl_random_pseudo_bytes(16);
	$encdata = @openssl_encrypt($data, "AES-128-ECB", $key, true, $iv);
	return $encdata;
}

// API CALL foreach 예시
function jsonRespDump($resp){

    $response = explode(",", $resp);
    $response_convert = [];

	foreach ( $response as $key => $res ){

        if ($key == 0) {
            $res = str_replace("{", "", $res);
        }
        if ($key == count($response) - 1) {
            $res = str_replace("}", "", $res);
        }
        $res_array = explode(":", $res);
        if ($res_array[0] == '"ResultMsg"') {
            $res_array[1] = iconv("EUC-KR", "UTF-8", $res_array[1]);
        }
        $res_key = $res_array[0];
        $res_value = $res_array[1];
        $response_convert[$res_key] = $res_value;

		echo "$res_key=". $res_value."<br />";
	}
}

//Post api call
function reqPost(Array $data, $url){
	$requestData = stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => 'Content-type: application/x-www-form-urlencoded;charset=utf-8"',
			'content' => http_build_query($data),
			'timeout' => 15
		)
	));

	$response = file_get_contents($url, FALSE, $requestData);
	return $response;
}

?>
