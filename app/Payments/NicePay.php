<?php


namespace App\Payments;

/*
 *
 *
 *
 *
 * !!!사용 안함!!!
 * 아임포트로 나이스페이 연동하게 되어서 사용안함
 * 해당 방법은 나이스페이를 직접 연동하는 방법임!
 *
 *
 *
 *
 */
class NicePay
{

    public static function KeyInResult($request)
    {
        $mid = $request->input("MID");                            // 상점 아이디
        $tid = $request->input("TID");                            // 거래번호
        $moid = $request->input("Moid");                            // 상점 주문번호
        $amt = $request->input("Amt");                            // 금액
        $goodsName = $request->input("GoodsName");                // 상품명
        $cardInterest = $request->input("CardInterest");            // 무이자 여부
        $cardQuota = $request->input("CardQuota");                // 할부 개월
        $charSet = $request->input("CharSet");
        $cardNo = $request->input("CardNo");
        $cardExpire = $request->input("CardExpire");
        $buyerAuthNum = $request->input("BuyerAuthNum");
        $cardPwd = $request->input("CardPwd");
        $keyinRequestURL = "https://webapi.nicepay.co.kr/webapi/card_keyin.jsp";

        $response = "";

        /*
        *******************************************************
        * <해쉬암호화> (수정하지 마세요)
        * SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
        *******************************************************
        */
        $plainText = "CardNo=" . $cardNo . "&CardExpire=" . $cardExpire . "&BuyerAuthNum=" . $buyerAuthNum . "&CardPwd=" . $cardPwd;
        $ediDate = date("YmdHis");
        $merchantKey = "b+zhZ4yOZ7FsH8pm5lhDfHZEb79tIwnjsdA0FBXh86yLc6BJeFVrZFXhAoJ3gEWgrWwN+lJMV0W4hvDdbe4Sjw=="; // 상점키
        $encData = bin2hex(aesEncryptSSL($plainText, substr($merchantKey, 0, 16)));
        $signData = bin2hex(hash('sha256', $mid . $amt . $ediDate . $moid . $merchantKey, true));

        $data = array(
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

        $requestData = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded;charset=utf-8"',
                'content' => http_build_query($data),
                'timeout' => 15
            )
        ));

        $response = file_get_contents($keyinRequestURL, FALSE, $requestData);
        $response = explode(",", $response);
        $response_convert = [];

        foreach ($response as $key => $res ) {

            if ($key == 0) {
                $res = str_replace("{", "", $res);
            }
            if ($key == count($response) - 1) {
                $res = str_replace("}", "", $res);
            }
            $res_array = explode(":", $res);
            $iconv_arr = [ '"ResultMsg"', '"AcquCardName"', '"CardName"' ];
            if (in_array($res_array[0], $iconv_arr)) {
                $res_array[1] = iconv("EUC-KR", "UTF-8", $res_array[1]);
            }
            $res_array[1] = str_replace('"', '', $res_array[1]);
            $res_key = $res_array[0];
            $res_value = $res_array[1];
            $response_convert[$res_key] = $res_value;

        }

        return $response_convert;
    }

}
