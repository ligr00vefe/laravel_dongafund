@extends("layouts/layout")

@section("title")
    전자서명
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
@endpush

@section("content")

    <div id="modalWrapper" class="modal-wrapper">
        <div class="modal modal1">
            <div class="modal-head">
                <button class="close-button"></button>
            </div>

            <div class="modal-contents">
                <img src="/img/modal_check.png" alt="모달 체크">
                <p class="success">인증 요청이 발송됐습니다</p>
                <p class="text">
                    모바일 기기로 발송된 인증을 완료하셨으면<br>
                    아래 확인 버튼을 눌러주세요
                </p>
                <form action="" onsubmit="return signatureVerify(this)">
                    <input type="hidden" name="receiptId">
                    <button id="signatureConfirm" class="modal-confirm">
                        확인
                    </button>
                </form>
            </div>
        </div>

        <div class="modal modal2">
            <div class="modal-head">
                <button class="close-button"></button>
            </div>

            <div class="modal-contents">
                <img src="/img/modal_check.png" alt="모달 체크">
                <p class="success">전자서명을 진행해주세요</p>
                <canvas id="canvas" style="border: 1px solid black; margin-bottom: 10px;"></canvas>
                <div>
                    <button type="button" id="clearButton">지우기</button>
                    <button type="button" id="canvasButton" onclick="canvasButton()">확인</button>
                </div>
            </div>
        </div>

        <div class="">

        </div>

    </div>

    <form action="/signature" name="iamportForm" method="post">
        @csrf
        <input type="hidden" name="donation_id" value="{{ $donation->id }}">
        <input type="hidden" name="program_id" value="{{ $donation->program_id }}">
        <input type="hidden" name="signature_type" value="1">
        <input type="hidden" name="signature_pass" value="2">
        <input type="hidden" name="signature_save_id" value="0">
        <input type="hidden" id="receiptId" name="receiptId" value="">
        <input type="hidden" id="signedData" name="signedData" value="">
        <div>
            <input type="hidden" name="card_number" value="{{ $donation->credit_cart_number }}">
        </div>
        <div>
            <input type="hidden" name="expiry" value="{{ $donation->credit_cart_expiration }}">
        </div>
        <div>
            <input type="hidden" name="birth" value="{{ substr($donation->regNumber, 0, 6) }}">
        </div>
        <div>
            <input type="hidden" id="pwd_2digit" name="pwd_2digit">
        </div>
        <input hidden type="text" value="{{ $customer_uid }}" name="customer_uid">
    </form>


    <form action="/signature" id="verifyForm" name="verifyForm" method="post" onsubmit="">
        @csrf
        <input type="hidden" name="donation_id" value="{{ $donation->id }}">
        <input type="hidden" name="program_id" value="{{ $donation->program_id }}">
        <input type="hidden" name="signature_type" value="1">
        <input type="hidden" name="signature_pass" value="2">
        <input type="hidden" name="signature_save_id" value="0">

        <input type="hidden" name="MID" value="{{ $mid }}">
        <input type="hidden" name="Moid" value="{{ $moid }}">
        <input type="hidden" name="GoodsName" value="{{ $goodsName }}">
        <input type="hidden" name="TID" value="{{ $mid . "01" . "01" . date("ymdhis") . bin2hex(random_bytes(2)) }}">
        <input type="hidden" name="Amt" value="{{ $price ?? 0 }}">
        <input type="hidden" name="CardNo" value="{{ $donation->credit_card_number }}">
        <input type="hidden" name="CardExpire" value="{{ $donation->credit_card_expiration }}">
        <input type="hidden" name="BuyerAuthNum" value="{{ $donation->regNumber }}">
        <input type="hidden" name="CardPwd" value="19">
        <input type="hidden" name="CardInterest" value="0"/> {{-- "": 미선택, 0: 일반, 1: 무이자--}}
        <input type="hidden" name="CardQuota" value="00">
    </form>

    <section class="signature">

        <div class="signature-container">

            <form action="" onsubmit="return validate(this)">

            <div class="signature-cell">

                <div class="signature-head">
                    <i class="fa fa-signature"></i>
                    <span class="dot-orange-bottom"></span>
                    <h3>
                        전자서명
                    </h3>
                </div>

                <div class="signature-body">

                    <div class="signature-body__row">
                        <p class="signature__sub-title">
                            약정정보
                        </p>

                        <div class="signature-body__contents">

                            @includeWhen($donation->donation_type == "일시기부", "signature.include.once")
                            @includeWhen($donation->donation_type == "정기기부", "signature.include.regular")
                            @includeWhen($donation->donation_type == "분할납부", "signature.include.divide")

                        </div>

                    </div>

                    <div class="signature-body__row">

                        <p class="signature__sub-title">
                            전자서명
                        </p>

                        <div class="signature-body__form">

                            <ul class="signature-selector">
                                <li class="on">
                                    <a href="#" data-type="1">
                                        <img src="/img/kakaopay.png" alt="카카오페이">
                                        전자서명
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-type="2">
                                        일반 전자서명
                                    </a>
                                </li>
                            </ul>

                            <div class="line-100-gray"></div>

                            <div class="signature-body__form__input-wrap">


                                <div>
                                    <div class="swp-input-wrap type-required ">
                                        <span class="">성명</span>
                                        <input type="text" id="name" name="name" value="">
                                    </div>
                                </div>

                                <div>
                                    <div class="swp-input-wrap type-required ">
                                        <span>휴대폰번호</span>
                                        <input type="text" id="hp" name="hp" value="">
                                    </div>
                                </div>

                                <div>
                                    <div class="swp-input-wrap type-required ">
                                        <span>생년월일 (8자리)</span>
                                        <input type="text" id="birth" name="birth" value="">
                                    </div>
                                </div>

                            </div>


                            <div id="signature_agreement" class="checkbox-wrap--border">

                                <div class="spread spread-animation">

                                    <input type="checkbox" name="receipt" id="receipt" class="spread-checkbox">
                                    <label for="receipt"></label>
                                    <div class="checkbox-wrap__divider">
                                        <p class="checkbox-wrap__p--small">개인정보 제3자 제공 동의</p>
                                        <p class="checkbox-wrap__p--big">
                                            전자서명 목적
                                        </p>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-chevron-up"></i>

                                    <div class="description">
                                        <p>
                                            1. 제공받는자: (주)링크허브
                                        </p>
                                        <p>
                                            2. 목적: 전자서명 (카카오페이 인증서)
                                        </p>
                                        <p>
                                            3. 제공받는자의 보유기간: 5년
                                        </p>
                                        <p>
                                            4. 제공항목: 성명, 휴대폰번호, 생년월일
                                        </p>
                                        <p>
                                            5. 기부자는 개인정보 제3자 제공을 거부하실 수 있습니다. 거부하실 경우 카카오페이 전자서명 이용이 불가능하며 일반 전자서명만 이용가능합니다.
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <input type="text" id="password_" name="password" placeholder="카드비밀번호 앞 2자리만" style="display: none;">


                        </div>

                    </div>

                </div>

            </div>

            <div class="signature-submit">


                <button>
                    <i class="fa fa-signature"></i>
                    서명하기
                </button>

            </div>
            </form>

        </div>

    </section>

    <script>


        function validate(f)
        {
            let error = false;

            if (f.name.parentNode.classList.contains("type-required-warning")) f.name.parentNode.classList.remove("type-required-warning");
            if (f.hp.parentNode.classList.contains("type-required-warning")) f.hp.parentNode.classList.remove("type-required-warning");
            if (f.birth.parentNode.classList.contains("type-required-warning")) f.birth.parentNode.classList.remove("type-required-warning");
            if (f.receipt.parentNode.parentNode.classList.contains("type-required-warning")) f.receipt.parentNode.parentNode.classList.remove("type-required-warning");

            if (f.name.value == "" && !f.name.disabled) {
                f.name.parentNode.classList.add("type-required-warning")
                f.name.focus();
                error = true;
            }
            if (f.hp.value == "" && !f.hp.disabled) {
                f.hp.parentNode.classList.add("type-required-warning")
                f.hp.focus();
                error = true;
            }
            if (f.birth.value == "" && !f.birth.disabled) {
                f.birth.parentNode.classList.add("type-required-warning")
                f.birth.focus();
                error = true;
            }
            if (!f.receipt.checked && !f.receipt.disabled) {
                f.receipt.parentNode.parentNode.classList.add("type-required-warning")
                error = true;
            }
            if (error) {
                return false;
            }

            document.querySelector("input[name='CardPwd']").value = f.password.value;

            const signatureType = document.querySelector("input[name='signature_type']").value;
            const modal = document.getElementById("modalWrapper");
            modal.style.display = "flex";

            if (signatureType == 1) {
                axios.post("/async/kakao/cert/request", {
                    name: f.name.value,
                    hp: f.hp.value,
                    birth: f.birth.value
                })
                    .then(function (response) {

                        if (response.data.error) {
                            alert(response.data.message + " 관리자에게 문의해주세요.");
                            return false;
                        }

                        if (response.status == 200) {
                            document.querySelector("input[name='receiptId']").value = response.data.receiptId
                            modal.querySelector(".modal1").style.display = "block";
                        } else {
                            alert("문제가 발생했습니다. 다시 시도해 주세요.");
                            modal.style.display = "none";
                        }

                    });
            } else if (signatureType == 2) {
                modal.querySelector(".modal2").style.display = "block";
            }

            return false;
        }

        // 인증검증하기
        function signatureVerify(f)
        {
            axios.post("/async/kakao/cert/state", {
                receiptId: f.receiptId.value
            })
                .then(function (stateResponse) {

                    if (stateResponse.status != 200) {
                        alert("문제가 발생했습니다. 다시 시도해 주세요");
                        return false;
                    }

                    if (stateResponse.data.result.state != 1) {
                        alert("인증에 실패했습니다. 다시 시도해 주세요");
                        return false;
                    }

                    axios.post("/async/kakao/cert/verify", {
                        receiptId: f.receiptId.value
                    })

                        .then(function (verifyResponse) {

                            if (verifyResponse.status != 200) {
                                alert("검증에 문제가 발생했습니다. 다시 시도해 주세요");
                                location.reload();
                            }

                            if (verifyResponse.data.result.receiptId == f.receiptId.value) {
                                alert("전자서명에 성공했습니다.");
                                document.querySelector("input[name='signature_type']").value = 1;
                                document.querySelector("input[name='signature_pass']").value = 1;
                                document.querySelector("input#receiptId").value = verifyResponse.data.result.receiptId
                                document.querySelector("input#signedData").value = verifyResponse.data.result.signedData
                                document.getElementById("pwd_2digit").value = document.getElementById("password_").value;
                                document.getElementById("modalWrapper").style.display = "none";
                                document.iamportForm.submit();
                            }

                        })

                })

            return false;
        }


        const signatureSelector = document.querySelectorAll(".signature-selector li a");
        const input_signature_type = document.querySelector("input[name='signature_type']");

        signatureSelector.forEach(function (i) {

            i.onclick = function (e) {
                e.preventDefault();

                input_signature_type.value = i.dataset.type
                const _focus = document.querySelector(".signature-selector li.on");
                if (_focus) {
                    _focus.classList.remove("on");
                }
                i.parentNode.classList.add("on");

                const $inputWrap = document.querySelectorAll(".signature-body__form__input-wrap .swp-input-wrap");
                const $checkboxWrap = document.getElementById("signature_agreement");

                if (i.dataset.type == 1) {
                    $inputWrap.forEach(function (wrap) {
                        wrap.style.backgroundColor = "white";
                        wrap.querySelector("input").disabled = false;
                        $checkboxWrap.style.backgroundColor = "white";
                        $checkboxWrap.querySelector("input").disabled = false;
                    })
                } else {
                    $inputWrap.forEach(function (wrap) {
                        wrap.style.backgroundColor = "#dbdbdb";
                        wrap.querySelector("input").disabled = true;
                        $checkboxWrap.style.backgroundColor = "#dbdbdb";
                        $checkboxWrap.querySelector("input").disabled = true;
                    })
                }

            }

        });

        var canvas = document.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas);
        canvas.width = 400;

        window.addEventListener("resize", resizeCanvas);
        function resizeCanvas() {
            signaturePad.clear();
        }

        document.getElementById("clearButton").onclick = function () {
            signaturePad.clear();
        }


        function canvasButton() {

            axios.post("/async/signature/save", {
                    params: signaturePad.toDataURL('image/png')
                })
                .then(function (response) {
                    document.querySelector("input[name='signature_type']").value = 2;
                    document.querySelector("input[name='signature_pass']").value = 1;
                    document.querySelector("input[name='signature_save_id']").value = response.data.id;
                    document.getElementById("modalWrapper").style.display = "none";
                    document.getElementById("pwd_2digit").value = document.getElementById("password_").value;
                    document.iamportForm.submit();
                })

        }


        function IamPortRequest()
        {

        }

    </script>

@endsection
