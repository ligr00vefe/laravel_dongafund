@extends("layouts/layout")

@section("title")
    본인인증
@endsection

@push("scripts")

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
                <form action="/auth/check" name="verifyForm" method="post" onsubmit="return signatureVerify(this)">
                    @csrf
                    <input type="hidden" name="return" value="{{ $return ?? "/" }}">
                    <input type="hidden" id="receiptID" name="receiptID">
                    <input type="hidden" id="" name="name">
                    <input type="hidden" id="" name="tel">
                    <input type="hidden" id="" name="birth">
                    <input type="hidden" id="state" name="state">
                    <button id="signatureConfirm" class="modal-confirm">
                        확인
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="auth-check">

        <div class="auth-check-form">

            <form action="" name="authForm" onsubmit="return validation(this)">

            <div class="auth-check-form__content">

                <div class="auth-check__title">
                    <p>
                        <i class="fa fa-user"></i>
                        <span class="dot-sky-bottom"></span>
                        본인인증
                    </p>

                </div>

                <div class="auth-check__body">

                    <div class="auth-check__body-subject">

                        <p>
                            <img src="/img/kakaopay.png" alt="카카오페이">
                            카카오페이 본인인증
                        </p>

                    </div>

                    <div class="auth-check__body-input-wrap">

                        <div class="swp-input-wrap type-required">
                            <div class="row">
                                <span class="">성명</span>
                                <input type="text" name="name" id="name" placeholder="" value="">
                            </div>
                        </div>

                        <div class="swp-input-wrap type-required">
                            <div class="row">
                                <span>휴대폰번호</span>
                                <input type="text" name="tel" id="tel" placeholder="" value="">
                            </div>
                        </div>

                        <div class="swp-input-wrap type-required">
                            <div class="row">
                                <span>생년월일 (8자리)</span>
                                <input type="text" name="birth" id="birth" placeholder="">
                            </div>
                        </div>

                        <div class="checkbox-wrap--border">

                            <div class="spread">

                                <input type="checkbox" name="receipt" id="receipt" class="spread-checkbox" value="1">
                                <label for="receipt"></label>
                                <div class="checkbox-wrap__divider">
                                    <p class="checkbox-wrap__p--small">개인정보 제3자 제공 동의</p>
                                    <p class="checkbox-wrap__p--big">
                                        본인인증 목적
                                    </p>
                                </div>
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-chevron-up"></i>

                                <div class="description">
                                    <p>
                                        1. 제공받는자: (주)링크허브
                                    </p>
                                    <p>
                                        2. 목적: 카카오페이 본인인증
                                    </p>
                                    <p>
                                        3. 제공받는자의 보유기간: 5년
                                    </p>
                                    <p>
                                        4. 제공항목: 성명, 휴대폰번호, 생년월일
                                    </p>
                                    <p>
                                        5. 기부자는 개인정보 제3자 제공을 거부하실 수 있습니다. 거부하실 경우 기부내역 조회, 기부금 영수증 발급, 개인정보변경 웹서비스 이용이 불가능하여 다른 수단(전화, 직접방문)을 이용하셔야 합니다.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="auth-check__footer">

                <button>
                    <i class="fa fa-key"></i>
                    본인인증
                </button>
                <div class="link-wrap">
                    <table class="question-table">
                        <tbody>
                        <tr>
                            <th>
                                <i class="fa fa-exclamation-circle"></i>
                            </th>
                            <td>
                                <p>
                                    학생이나 교직원 이신가요?
                                    <a href="/auth/login">
                                        로그인
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="fa fa-question-circle"></i>
                            </th>
                            <td>
                                <p>
                                    인증 불가시 대외협력처로 전화주시면 담당자가 직접 안내 드리겠습니다.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="fa fa-phone"></i>
                            </th>
                            <td>
                                <p>
                                    051-200-6012 (대외협력처)
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            </form>

        </div>

    </div>

    <script>
        const spread = document.querySelector(".spread");

        spread.onclick = function() {
            slideToggle(spread.querySelector(".description"), 400);
        }

        // 본인인증 시작
        function validation(f)
        {
            let error = false;
            let msg = "";

            document.getElementById("name").parentNode.parentNode.classList.remove("type-required-warning");
            document.getElementById("tel").parentNode.parentNode.classList.remove("type-required-warning");
            document.getElementById("birth").parentNode.parentNode.classList.remove("type-required-warning");

            if (f.name.value == "") {
                msg = "이름을 입력해주세요";
                document.getElementById("name").parentNode.parentNode.classList.add("type-required-warning");
                error = true;
            }

            if (f.tel.value == "") {
                msg = msg != "" ? msg : "휴대폰번호를 입력해주세요";
                document.getElementById("tel").parentNode.parentNode.classList.add("type-required-warning");
                error = true;
            }

            if (f.birth.value == "") {
                msg = msg != "" ? msg : "생년월일을 입력해주세요";
                document.getElementById("birth").parentNode.parentNode.classList.add("type-required-warning");
                error = true;
            }

            if (!f.receipt.checked) {
                msg = msg != "" ? msg : "개인정보 제3자 제공 동의를 해주세요";
                document.getElementById("receipt").parentNode.parentNode.classList.add("type-required-warning");
                error = true;
            }

            if (error) {
                alert(msg);
                return false;
            }

            /* 테스트서버에서만 사용중 */
            document.querySelector("form[name='verifyForm'] input[name='tel']").value = f.tel.value;
            document.querySelector("form[name='verifyForm'] input[name='name']").value = f.name.value;
            document.querySelector("form[name='verifyForm'] input[name='birth']").value = f.birth.value;

            document.getElementById("modalWrapper").style.display = "flex";
            document.querySelector(".modal").style.display = "block";

            axios.post("/async/kakao/auth/request", {
                birth: f.birth.value,
                name: f.name.value,
                tel: f.tel.value
            })
            .then(function (response) {
                if (response.data.code == 1) {
                    document.getElementById("receiptID").value = response.data.data.receiptID
                    document.querySelector("form[name='verifyForm'] input[name='tel']").value = f.tel.value;
                    document.querySelector("form[name='verifyForm'] input[name='name']").value = f.name.value;
                    document.querySelector("form[name='verifyForm'] input[name='birth']").value = f.birth.value;
                } else {
                    alert("카카오 요청에 오류가 발생했습니다. 같은 현상이 계속되면 관리자에게 문의해주세요(테스트중이므로 실패해도 넘어갑니다) " + response.data.message);
                }
            })

            return false;

        }


        // 카카오 인증 후에 state 발급받기
        function signatureVerify(f) {

            // state 값이 없으면 state 발급받기
            if (f.state.value == "") {
                axios.post("/async/kakao/auth/state", {
                    receiptID: f.receiptID.value
                })
                    .then(function (response) {
                        document.getElementById("state").value = response.data.data.state
                        document.verifyForm.submit();
                    })
                    .catch(function (err) {
                        alert("카카오 요청에 오류가 발생했습니다. 같은 현상이 계속되면 관리자에게 문의해주세요 " + err);
                    });

                return false;
            }

            // state 값이 1이면 submit
            else if (f.state.value == 1) {
                return true;
            }

        }


        // 인증 요청이 발송됐습니다 창 끄기
        document.querySelector(".close-button").addEventListener("click", function () {
            document.getElementById("modalWrapper").style.display = "none";
            document.querySelector(".modal").style.display = "none";
        });

    </script>


@endsection
