<?php
header("Content-Type:text/html; charset=utf-8;");

$mid         = "nictest04m"; // 상점아이디
$moid        = "moid1234567890"; // 주문번호
$goodsName   = "현금영수증발급상품"; // 상품명

?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY KEYIN REQUEST(UTF-8)</title>
<meta charset="utf-8">
<style>
	html,body {
        height: 100%;
    }
	form {
        overflow: hidden;
    }
</style>

<script type="text/javascript">
function nicepay(){
	document.requestForm.submit();
}
</script>
</head>
<body>
<form name="requestForm" method="post" action="/bri/payment/result">
    @csrf
	<table>
		<tr>
			<th><span>상점 ID</span></th>
			<td><input type="text" name="MID" value="<?php echo($mid)?>"></td>
		</tr>
		<tr>
			<th><span>주문번호</span></th>
			<td><input type="text" name="Moid" value="<?php echo($moid)?>"></td>
		</tr>
		<tr>
			<th><span>상품명</span></th>
			<td><input type="text" name="GoodsName" value="<?php echo($goodsName)?>"></td>
		</tr>
		<tr>
			<th><span>거래번호(TID)</span></th>
			<td><input type="text" name="TID" value="{{ $mid . "01" . "01" . date("ymdhis") . bin2hex(random_bytes(2)) }}"></td>
		</tr>
		<tr>
			<th><span>결제 금액</span></th>
			<td><input type="text" name="Amt" value="1000"></td>
		</tr>
		<tr>
			<th><span>카드번호</span></th>
			<td><input type="text" name="CardNo" value="3333117471354"></td>
		</tr>
		<tr>
			<th><span>유효기간(YYMM)</span></th>
			<td><input type="text" name="CardExpire" value="1025"></td>
		</tr>

		<tr>
			<th><span>생년월일 / 사업자번호</span></th>
			<td><input type="text" name="BuyerAuthNum" value="911128"></td>
		</tr>
		<tr>
			<th><span>카드 비밀번호 앞 2자리</span></th>
			<td><input type="text" name="CardPwd" value="19"></td>
		</tr>
		<tr>
			<th><span>무이자 여부</span></th>
			<td>
			<input type="radio" name="CardInterest" value=""/>미선택
			<input type="radio" name="CardInterest" value="0" checked="checked"/> 일반
			<input type="radio" name="CardInterest" value="1"/> 무이자
			</td>
		</tr>
		<tr>
			<th><span>할부 개월</span></th>
			<td><input type="text" name="CardQuota" value="00"></td>
		</tr>

		<!-- 옵션 -->
		<input type="hidden" name="CharSet" value="utf-8"/>					<!-- 응답 파라미터 인코딩 방식 -->

	</table>
	<a href="#" class="btn_blue" onClick="nicepay();">요 청</a>
</form>
</body>
</html>
