<div class="donate-tab-wrap">
    <div class="donate-tab">
        <form action="/donate">
            <input type="hidden" name="program" value="7">
            <div class="dt-con dt-left">
                <img src="/img/logo_bi.png" alt="동아100년동행BI로고">
                <ul>
                    <li><button type="button" data-price="10,000" class="dt-btn__plus plus_1">1만</button></li>
                    <li><button type="button" data-price="50,000" class="dt-btn__plus plus_5">5만</button></li>
                    <li><button type="button" data-price="100,000" class="dt-btn__plus plus_10">10만</button></li>
                </ul>
            </div>
            <div class="dt-con dt-right">
                <input type="text" id="donor-tab-price" placeholder="0">
                <label for="donor-tab-price" class="donor-tab-price__label">원</label>
            </div>
            <button class="donate-btn">기부하기</button>
        </form>
    </div>{{-- .donate-tab end --}}
</div>{{-- .donate-tab-wrap end --}}

<script>
    const donateSelectButton = $(".dt-btn__plus");
    donateSelectButton.on("click", function () {
        let price = $(this).data("price");
        $("#donor-tab-price").val(price);
    })

</script>

<style>
    /*하단 기부버튼*/
    .donate-tab-wrap {width:100%;padding:36px 0;}
    .donate-tab {width:670px;height:80px;background:#fff;border:1px solid #F36F21;border-radius:83px;box-shadow: 0px 3px 4px #00000033;margin:0 auto;}
    .donate-tab form {position:relative;width:100%;height:100%;}
    .donate-tab form .dt-con {display:inline-block;}
    .donate-tab form .dt-left {float:left;position:relative;height:100%;top:0;}
    .donate-tab form .dt-left img {position: relative;width:48px;top:50%;transform:translateY(-50%);margin:0 17px 2px 30px;}
    .donate-tab form .dt-left ul {display:inline-block;height:100%;position: relative;vertical-align: top;}
    .donate-tab form .dt-left ul li {position:relative;display:inline-block;width:56px;top:50%;background:#fafafa;padding:7px 0;text-align:center;border-radius:10px;margin:0 5px;transform: translateY(-50%);}
    .donate-tab form .dt-left ul li button {font-size:14px;font-family:paybooc-Medium;letter-spacing: -0.35px;line-height:22px;color:#555;background:transparent;border:0;}
    .donate-tab form .dt-right {float:left;position:relative;height:100%;}
    .donate-tab form .dt-right input#donor-tab-price {width:193px;height:36px;font-size:24px;font-family:paybooc-Bold;letter-spacing:-0.6px;line-height:36px;color:#555;text-align:right;padding-right:38px;border:0;border-bottom:1px solid #d7d7d7;margin:25px 7px 20px 17px;}
    .donate-tab form .dt-right label.donor-tab-price__label {position:absolute;left:185px;top:50%;transform:translateY(-21%);font-size:14px;font-family:paybooc-Medium;letter-spacing: -0.35px;line-height:22px;color:#555;}
    .donate-tab form button.donate-btn {position:absolute;width:120px;height:56px;top:50%;right:12px;transform:translateY(-50%);font-size:18px;font-family:paybooc-Bold;line-height:25px;color:#fff;background:linear-gradient(90deg, #FB6913 0%, #FF9223 100%);border:0;border-radius:28px;}

    /*반응형*/
    @media (max-width:1280px) {
        .donate-tab-wrap {width:100%;padding:24px 0;}
        .donate-tab {width:538px;height:68px;border-radius:83px;box-shadow: 0px 3px 4px #00000033;margin:0 auto;}
        .donate-tab form {}
        .donate-tab form .dt-con {display:inline-block;}
        .donate-tab form .dt-left {}
        .donate-tab form .dt-left img {width:48px;margin:auto 7px 2px 20px;}
        .donate-tab form .dt-left ul li {width:56px;padding:7px 0;border-radius:10px;margin:0 2px;}
        .donate-tab form .dt-left ul li button {font-size:14px;letter-spacing: -0.35px;line-height:22px;}
        .donate-tab form .dt-right input#donor-tab-price {width:150px;height:30px;font-size:18px;letter-spacing:-0.45px;line-height:28px;padding-right:25px;margin:22px 6px 0 10px;}
        .donate-tab form .dt-right label.donor-tab-price__label {left:140px;top:50%;transform:translateY(-30%);font-size:14px;letter-spacing: -0.35px;line-height:22px;}
        .donate-tab form button.donate-btn {width:90px;height:44px;font-size:16px;line-height:24px;border-radius:22px;}
    }
    @media (max-width:768px) {

        .donate-tab-wrap {width:100%;padding:24px 0;
            display: none; /* 모바일일 때 안보이게 해달라는 요청 21.06.03 */
        }
        .donate-tab {width:300px;height:60px;border-radius:35px;box-shadow: 0 3px 4px #00000033;margin:0 auto;}
        .donate-tab form {}
        .donate-tab form .dt-con {display:inline-block;}
        .donate-tab form .dt-left {width:auto;}
        .donate-tab form .dt-left img {width:36px;margin: auto 0 2px 15px;}
        .donate-tab form .dt-left ul {display:none;}
        .donate-tab form .dt-right {width:auto;float: left;}
        .donate-tab form .dt-right input#donor-tab-price {width:130px;height:30px;font-size:18px;letter-spacing:-0.45px;line-height:28px;padding-right:23px;margin:17px 6px 15px 10px;}
        .donate-tab form .dt-right label.donor-tab-price__label {left:125px;top:50%;transform:translateY(-34%);font-size:14px;letter-spacing: -0.35px;line-height:22px;}
        .donate-tab form button.donate-btn {width:84px;height:36px;font-size:16px;line-height:20px;border-radius:18px;}
    }
</style>
