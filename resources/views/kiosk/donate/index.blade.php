@extends("layouts/layout")

@section("title")
    대학발전 전반 지원
@endsection

@push("scripts")
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
@endpush

@section("content")
    <section class="donate">

        <div class="donate-head">
            <div class="head-background" style="background-image:
                url({{
                    $program->thumbnail != 0
                    ? "storage/" .getAttachPath($program->thumbnail)
                    : "/img/contract_top_noimg.jpg"
                    }})">

            </div>
        </div>

        <div class="donate-body">

            <div class="donate-form">


                <div class="donate-form__body">

                    <form action="/kiosk/donate" method="post" onsubmit="return validate(this)">
                        @csrf
                        <input type="hidden" name="kiosk_url" value="{{ $kiosk_url }}">
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" id="fixing_check" name="fixing_check" value="{{ $program->fixing_check ?? 2 }}">
                        <input type="hidden" id="donation_type" name="donation_type" value="일시기부">
                        <input type="hidden" id="donator_type" name="donator_type" value="개인">
                        <input type="hidden" id="payment_type" name="payment_type" value="키오스크결제">
                        <input type="hidden" id="donation_price" name="donation_price" value="1">

{{--                    <div class="donate-info border-shadow">--}}

{{--                        <div class="donate-info__head">--}}

{{--                            <h3>--}}
{{--                                1 <span class="dot-orange-bottom"></span> 기부정보--}}
{{--                            </h3>--}}

{{--                            <div class="donate-question">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fa fa-question-circle"></i>--}}
{{--                                    <span>--}}
{{--                                        복잡해서 어려움을 겪고 계신가요?--}}
{{--                                    </span>--}}
{{--                                </a>--}}
{{--                                <div class="modal-small">--}}
{{--                                    <p>--}}
{{--                                        대외협력처로 전화주시면 상세히 안내드리겠습니다.--}}
{{--                                    </p>--}}
{{--                                    <p>--}}
{{--                                        <i class="fa fa-phone"></i> 051-200-6012--}}
{{--                                    </p>--}}
{{--                                    <p class="bottom-detail">--}}
{{--                                        자세히 보기--}}
{{--                                        <i class="fa fa-chevron-right"></i>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="donate-info__body">--}}

{{--                            <ul id="donateTypes" class="donate-types">--}}
{{--                                <li>--}}
{{--                                    <a href="#" data-type="정기기부" data-use="{{ $program->donation_type1 == "1" ? "true" : "false" }}">정기기부</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" data-type="일시기부" data-use="{{ $program->donation_type2 == "1" ? "true" : "false" }}">일시기부</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" data-type="분할납부" data-use="{{ $program->donation_type3 == "1" ? "true" : "false" }}">분할납부</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}

{{--                            <ul class="donate-price">--}}
{{--                                <li class="flex-center" data-price="1">--}}
{{--                                    <a href="#" type="button" data-price="1" class="">--}}
{{--                                        <p class="type-routine">매달</p>--}}
{{--                                        <p>1만원</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="flex-center" data-price="3">--}}
{{--                                    <a href="#" type="button" data-price="3">--}}
{{--                                        <p class="type-routine">매달</p>--}}
{{--                                        <p>3만원</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="flex-center" data-price="5">--}}
{{--                                    <a href="#" type="button" data-price="5">--}}
{{--                                        <p class="type-routine">매달</p>--}}
{{--                                        <p>5만원</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="flex-center" data-price="10">--}}
{{--                                    <a href="#" type="button" data-price="10">--}}
{{--                                        <p class="type-routine">매달</p>--}}
{{--                                        <p>10만원</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="price-input-wrap custom" data-visible="routine">--}}
{{--                                    <div class="divide-input">--}}
{{--                                        <input type="text" name="donation_price" class="donate_price" value="{{ issetNumberFormat($program->fixing_price ?? 0) }}" readonly>--}}
{{--                                    </div>--}}
{{--                                    <p class="warning-msg donation_price_msg">--}}
{{--                                        카카오페이는 500만원 미만의 결제가 가능합니다.--}}
{{--                                    </p>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                            <ul class="donate-divide-selector">--}}

{{--                                <li class="input-wrap-top-msg">--}}
{{--                                    <span class="top-msg">--}}
{{--                                        분할횟수--}}
{{--                                    </span>--}}
{{--                                    <div class="input-plus-minus-wrap">--}}
{{--                                        <button type="button" id="priceAdd" class="input-calc-button" data-calc="+">+</button>--}}
{{--                                        <input type="text" name="divide_count" readonly value="10회">--}}
{{--                                        <button type="button" id="priceSub" class="input-calc-button" data-calc="-">-</button>--}}
{{--                                    </div>--}}
{{--                                </li>--}}

{{--                                <li class="input-wrap-top-msg">--}}
{{--                                    <span class="top-msg">--}}
{{--                                        월 기부금액--}}
{{--                                    </span>--}}
{{--                                    <div class="input-divider-wrap">--}}
{{--                                        <span id="divideNotice">개월 간 매달</span>--}}
{{--                                        <input type="text" name="divide_price" readonly value="">--}}
{{--                                    </div>--}}

{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </div>--}}

{{--                    </div>--}}


                    <div class="donator-info border-shadow">

                        <div class="donator-info__head">

                            <h3>
                                기부자 정보
                            </h3>

                            <div id="help_what" class="donate-question">
                                <a href="#">
                                    <i class="fa fa-question-circle"></i>
                                    <span>
                                        이런게 왜 필요한가요 ?
                                    </span>
                                    <div class="modal-small">
                                        <p>
                                            관련법령에 따라 기부금 영수증 발급을 위한 정보입니다. 익명으로도 기부하실수 있으나 세제혜택을 받으실 수 없습니다.
                                        </p>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <div class="donator-info__body">

                            <ul id="donatorType" class="donator-type">
                                <li class="on">
                                    <a href="#" data-type="개인">개인</a>
                                </li>
                                <li>
                                    <a href="#" data-type="법인">법인</a>
                                </li>
                                <li>
                                    <a href="#" data-type="익명">익명</a>
                                </li>
                            </ul>

                            <div class="anony-hide">
                                <ul class="donator-privacy">
                                    <li class="swp-input-wrap type-required">
                                        <span class="label-input-name">성명</span>
                                        <input type="text" value="" name="name">
                                    </li>
                                    <li class="swp-input-wrap type-required">
                                        <span class="">전화번호</span>
                                        <input type="text" value="" name="tel">
                                    </li>
                                </ul>

                                <div class="rsno-wrap">
                                    <div class="swp-input-wrap  type-required">
                                        <span class="label-input-rsno">주민등록번호</span>
                                        <input type="text" id="rsno" name="regNumber" value="">
                                    </div>
                                </div>

                                <ul class="donator-address">
                                    <li class="swp-input-wrap input-wrap--small type-required">
                                        <span class="">우편번호</span>
                                        <input type="text" value="" id="zipcode" name="zipcode" onfocus="sample6_execDaumPostcode(this)">
                                    </li>
                                    <li class="swp-input-wrap type-required">
                                        <span class="">주소</span>
                                        <input type="text" class="--type-big" id="address1" value="" name="address1">
                                    </li>
                                    <li class="swp-input-wrap type-required">
                                        <span>상세주소</span>
                                        <input type="text" class="--type-big " id="address2" value="" name="address2">
                                    </li>
                                </ul>

                                <ul class="donator-addicted-info">
                                    <li class="select-wrap select-wrap--type-small type-required">
                                        <select id="relationship" class="arrow-hide" name="relationship">
                                            <option value="">학교와의 관계</option>
                                            <option value="일반">일반</option>
                                            <option value="동문">동문</option>
                                            <option value="학부모">학부모</option>
                                            <option value="법인">법인</option>
                                            <option value="교직원">교직원</option>
                                        </select>
                                        <i class="fa fa-chevron-down"></i>
                                    </li>

                                    <li id="enter_year_wrapper" class="select-wrap select-wrap--type-small type-required dis-none">
                                        <select id="" class="arrow-hide" name="enter_year" disabled>
                                            <option hidden selected>입학연도</option>
                                            {!! years_option() !!}
                                        </select>
                                        <i class="fa fa-chevron-down"></i>
                                    </li>
                                </ul>

                                <div class="college-wrap">
                                    <div id="course_wrapper" class="swp-input-wrap type-required dis-none">
                                        <span>학과/이수과정</span>
                                        <input type="text" name="course" class="--type-big " placeholder="" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

{{--                    <div class="donate-payment border-shadow">--}}

{{--                        <div class="donate-payment__head">--}}

{{--                            <h3>--}}
{{--                                3 <span class="dot-orange-bottom"></span> 납입방법--}}
{{--                            </h3>--}}

{{--                        </div>--}}

{{--                        <div class="donate-payment-body">--}}

{{--                            <ul id="paymentTypes" class="payment-types">--}}

{{--                                @if (strContain($program->payment_method ?? "", "무통장입금"))--}}
{{--                                    <li>--}}
{{--                                        <a href="#" data-type="무통장입금">--}}
{{--                                            무통장입금--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (strContain($program->payment_method ?? "", "자동이체"))--}}
{{--                                    <li>--}}
{{--                                        <a href="#" data-type="자동이체">--}}
{{--                                            자동이체--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (strContain($program->payment_method ?? "", "신용카드"))--}}
{{--                                    <li>--}}
{{--                                        <a href="#" data-type="신용카드">--}}
{{--                                            신용카드--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (strContain($program->payment_method ?? "", "카카오페이"))--}}
{{--                                    <li>--}}
{{--                                        <a href="#" data-type="카카오페이">--}}
{{--                                            <img src="/img/kakaopay.png" alt="카카오페이">--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (strContain($program->payment_method ?? "", "네이버페이"))--}}
{{--                                    <li>--}}
{{--                                        <a href="#" data-type="네이버페이">--}}
{{--                                            <img src="/img/naverpay.png" alt="네이버페이">--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                            </ul>--}}

{{--                        </div>--}}

{{--                        <div class="automatic-show">--}}

{{--                            <input type="hidden" name="automatic_transfer_assign_day" value="25" disabled>--}}
{{--                            <ul class="type-selector" id="automatic_transfer_assign">--}}
{{--                                <li class="on" data-day="25">--}}
{{--                                    <a href="#" >--}}
{{--                                        <p>매달 25일</p>--}}
{{--                                        <p>자동이체</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li data-day="10">--}}
{{--                                    <a href="#" >--}}
{{--                                        <p>매달 10일</p>--}}
{{--                                        <p>자동이체</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="border-none"></li>--}}
{{--                            </ul>--}}

{{--                            <ul class="ul-flex">--}}

{{--                                <li class="select-wrap select-wrap--type-small type-required">--}}
{{--                                    <select id="automatic_bank_name" class="arrow-hide" name="automatic_bank_name" disabled>--}}
{{--                                        <option value="" hidden>은행명</option>--}}
{{--                                        <option value="부산은행">부산은행</option>--}}
{{--                                    </select>--}}
{{--                                    <i class="fa fa-chevron-down"></i>--}}
{{--                                </li>--}}

{{--                                <li class="swp-input-wrap type-required">--}}
{{--                                    <span class="label-input-name">계좌번호</span>--}}
{{--                                    <input type="text" name="automatic_bank_number" value="" autocomplete="off" disabled>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </div>--}}

{{--                        <div class="creditcard-show">--}}
{{--                            <ul>--}}

{{--                                <li class="swp-input-wrap type-required">--}}
{{--                                    <span class="label-input-name">카드번호 (신한카드)</span>--}}
{{--                                    <input type="text" name="credit_card_number" value="" autocomplete="off" disabled>--}}
{{--                                </li>--}}

{{--                                <li class="swp-input-wrap type-required">--}}
{{--                                    <span class="label-input-name">유효기간 (YY/MM)</span>--}}
{{--                                    <input type="text" name="credit_card_expiration" value="" autocomplete="off" disabled>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </div>--}}

{{--                    </div>--}}

                    <div class="donate-agree border-shadow">
                        <div class="donate-agree__head">

                            <h3>
                                개인정보 수집·이용 및 제3자 제공 동의
                            </h3>

                        </div>

                        <div class="donate-agree__body">

                            <div class="checkbox-wrap">

                                <input type="checkbox" name="all_check" id="all_check">
                                <label for="all_check" class="checkbox--hide-small">
                                    <span class="checkbox--hide-small">
                                        전체동의 (필수수집정보, 선택수집정보, 제3자 제공정보)
                                    </span>

                                    <span class="checkbox--hide-middle">
                                        전체동의 (필수, 선택, 제3자 제공)
                                    </span>
                                </label>

                            </div>

                            <div id="receiptCheck" class="checkbox-wrap--border">

                                <div class="spread spread-animation">

                                    <input type="checkbox" name="receipt_check" id="receipt" value="1">
                                    <label for="receipt"></label>
                                    <div class="checkbox-wrap__divider">
                                        <p class="checkbox-wrap__p--small">필수수집정보</p>
                                        <p class="checkbox-wrap__p--big">
                                            기부자 영수증 발급용도
                                        </p>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-chevron-up"></i>

                                    <div class="description">
                                        <p>
                                            1. 수집항목: 성명, 주민등록번호, 연락처, 주소, 약정금액. 납입방법, 기부목적
                                        </p>
                                        <p>
                                            2. 보유/이용기간: 준영구 (기부자 요청 시 삭제가능)
                                        </p>
                                        <p>
                                            3. 기부자는 개인정보 수집을 거부하실 수 있습니다.
                                        </p>
                                        <p>
                                            4. 거부하실 경우 익명으로만 기부가능 하며 기부금 영수증 발급 불가, 기부내역 조회 불가, 예우혜택 제공 불가 등의 불이익이 발생할 수 있습니다.
                                        </p>
                                    </div>

                                </div>


                            </div>

                            <div class="checkbox-wrap--border">

                                <div class="spread spread-animation">

                                    <input type="checkbox" name="benefit_check" id="benefit" value="1">
                                    <label for="benefit"></label>
                                    <div class="checkbox-wrap__divider">
                                        <p class="checkbox-wrap__p--small">선택수집정보</p>
                                        <p class="checkbox-wrap__p--big">
                                            기부자 예우혜택 제공 용도
                                        </p>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-chevron-up"></i>

                                    <div class="description">
                                        <p>
                                            1. 목적: 소식지 발송, 감사선물 발송, 행사 안내, 관계에 따른 맞춤식 예우 등 예우혜택 제공
                                        </p>
                                        <p>
                                            2. 수집항목: 성명, 연락처, 주소, 학교와의 관계
                                        </p>
                                        <p>
                                            3. 개인정보 보유 및 이용기간: 준영구 (기부자 요청 시 삭제가능)
                                        </p>
                                        <p>
                                            4. 기부자는 개인정보 수집 및 이용을 거부하실 수 있습니다. 거부하실 경우 기부자 예우 혜택 제공 불가 등의 불이익이 발생할 수 있습니다.
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="checkbox-wrap--border">

                                <div class="spread spread-animation">

                                    <input type="checkbox" name="tax_check" id="tax" value="1">
                                    <label for="tax"></label>
                                    <div class="checkbox-wrap__divider">
                                        <p class="checkbox-wrap__p--small">제3자 제공정보</p>
                                        <p class="checkbox-wrap__p--big">
                                            세제혜택 편의 제공, 기부금 결제
                                        </p>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-chevron-up"></i>

                                    <div class="description">
                                        <p>
                                            1. 제공받는 자 | 목적 | 제공정보 | 보유기간
                                            <span class="m-left-10">가. 국세청 | 연말정산 간소화 서비스 등재 |성명, 주민등록번호, 연락처, 주소 | 5년</span>
                                            <span class="m-left-10">나. 금융결제원 | 자동이체 결제 | 성명, 생년월일, 연락처, 계좌정보 | 최종납입 종료시 까지</span>
                                            <span class="m-left-10">다. 효성FMS | 카드 결제 | 성명, 생년월일, 연락처, 카드정보 | 최종납입 종료시 까지</span>
                                        </p>
                                        <p>
                                            2. 기부자는 개인정보 제3자 제공을 거부하실 수 있습니다. 거부하실 경우 기부내역의 연말정산 간소화서비스 등재 불가, 자동이체 이용 불가, 카드결제 이용 불가 등의 불이익이 발생할 수 있습니다.
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="form-submit">
                        <button>
                            다음
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <script>



        function validate(f)
        {

            let validator = {
                program_id: {
                    msg: "프로그램명이 없습니다.",
                    required: true,
                },
                donation_type: {
                    msg: "기부유형을 선택해주세요.",
                    required: true,
                    focus: function () {
                        smoothScrolling(document.getElementById("donateTypes"), 300);
                    }
                },
                donator_type: {
                    msg: "기부자 유형을 선택해주세요.",
                    required: true
                },
                payment_type: {
                    msg: "납입방법을 선택해주세요.",
                    required: true,
                    focus: function () {
                        smoothScrolling(document.getElementById("paymentTypes"), 300);
                    }
                },
                receipt_check: {
                    msg: "기부자 영수증 발급용도를 체크해주세요.",
                    required: true,
                    focus: function () {
                        smoothScrolling(document.getElementById("receiptCheck"), 300);
                    }
                },
                donation_price: {
                    msg: "기부금액을 선택해주세요.",
                    required: true,
                    except: true,
                },
                divide_count: {
                    msg: "분할납부 분할횟수가 없습니다.",
                    required: true,
                },
                name: {
                    msg: "성명/법인명을 입력해주세요.",
                    required: true,
                },
                tel: {
                    msg: "전화번호를 입력해주세요.",
                    required: true,
                },
                regNumber: {
                    msg: "주민번호/사업자등록번호를 입력해주세요.",
                    required: true,
                },
                zipcode: {
                    msg: "우편번호를 입력해주세요.",
                    required: true,
                },
                address1: {
                    msg: "주소를 입력해주세요",
                    required: true,
                },
                address2: {
                    msg: "상세주소를 입력해주세요.",
                    required: true,
                },
                relationship: {
                    msg: "학교와의 관계를 선택해주세요.",
                    required: true,
                },
                enter_year: {
                    msg: "입학연도를 선택해주세요.",
                    required: true,
                },
                course: {
                    msg: "학과/이수과정을 입력해주세요.",
                    required: true,
                },
                automatic_transfer_assign_day: {
                    msg: "자동이체 지정일을 선택해주세요.",
                    required: true,
                },
                automatic_bank_name: {
                    msg: "자동이체 은행명을 선택해주세요.",
                    required: true,
                    except: true,
                },
                automatic_bank_number: {
                    msg: "자동이체 계좌번호를 입력해주세요.",
                    required: true,
                },
                benefit_check: {
                    msg: "기부자 예우혜택 제공 용도를 체크해주세요.",
                    required: false,
                },
                tax_check: {
                    msg: "세제혜택 편의 제공, 기부금 결제를 체크해주세요.",
                    required: false,
                },
                credit_card_number: {
                    msg: "신용카드 카드번호를 입력해주세요.",
                    required: true,
                },
                credit_card_expiration: {
                    msg: "신용카드 유효기간을 입력해주세요.",
                    required: true,
                },
            };

            let fail = false;

            for (let key in validator) {

                let error = f[key].value == "";
                let disable = false;
                const parent = f[key].parentNode;
                if (parent.classList.contains("type-required-warning")) parent.classList.remove("type-required-warning");

                if (key == "receipt_check" || key == "benefit_check" || key == "tax_check") {
                    error = !f[key].checked;
                }

                if (f[key].disabled) {
                    error = false;
                    disable = true;
                }

                validator[key].error = error;
                validator[key].disable = disable;


                if (error && validator[key].required) {
                    fail = true;
                    if (!validator[key].except
                        && parent.nodeName != "FORM"
                        && f[key].type != "checkbox"
                    ) {
                        parent.classList.add("type-required-warning");
                    }
                }

            }

            if (fail) {
                for (let key in validator) {
                    if (validator[key].error) {
                        alert(validator[key].msg);
                        if (!validator[key].focus) {
                            f[key].focus();
                        } else {
                            validator[key].focus()
                        }
                        return false;
                    }
                }
            }

        }

        document.querySelectorAll(".swp-input-wrap input, .swp-input-wrap select").forEach(function (i) {
            i.addEventListener("focus", function() {
                i.parentNode.classList.add("type-focus")
            });
            i.addEventListener("blur", function () {
                i.parentNode.classList.remove("type-focus")
            })
        })


        // 개인정보 수집 이용 동의 전체동의 버튼 누르기
        document.getElementById("all_check").onclick = function (e) {
            const _checked = e.target.checked;
            document.getElementById("receipt").checked = _checked;
            document.getElementById("benefit").checked = _checked;
            document.getElementById("tax").checked = _checked;
        }

        // 물음표 모달 띄우기
        document.querySelectorAll(".donate-question").forEach(function (i,v) {

            i.onclick = function () {
                event.preventDefault();
                const modal = this.querySelector(".modal-small");
                modal.style.display = modal.style.display === "block" ? "none" : "block";
            }

        });


        // 기부타입 변경하기
        const donationTypes = document.querySelectorAll(".donate .donate-info__body .donate-types li a");

        donationTypes.forEach(function (i,v) {

            i.onclick = function (e) {

                e.preventDefault();

                const use = i.dataset.use == "true" ? true : false;

                if (!use) {
                    alert("해당 프로그램에서 사용할 수 없는 기부방식입니다.");
                    return;
                }


                const selectedDonationType = document.querySelector(".donate .donate-info__body .donate-types li.on");
                const prt = i.parentNode;

                if (selectedDonationType && selectedDonationType.classList.contains("on")) {
                    selectedDonationType.classList.remove("on");
                }

                prt.classList.add("on");

                const type = i.dataset.type;
                const screenWidth = screen.availWidth;
                const donationInput = document.querySelector("input[name='donation_type']");

                donationInput.value = type;

                switch (type)
                {
                    case "정기기부":
                        handleDisplayChange({
                            block: [
                                ".donate .donate-info__body .donate-price li a p.type-routine"
                            ],
                            flex: [
                                ".donate .donate-info__body .donate-price li[data-price='1']",
                                ".donate .donate-info__body .donate-price li[data-price='3']",
                                ".donate .donate-info__body .donate-price li[data-price='10']"
                            ],
                            none: [
                                ".donate .donate-info__body .donate-price li[data-price='5']",
                                ".donate .donate-info__body .donate-divide-selector"
                            ]
                        })
                        document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                            _input.disabled = true;
                        })

                        break;

                    case "일시기부":
                        handleDisplayChange({
                            flex: [
                                ".donate .donate-info__body .donate-price li[data-price='3']",
                                ".donate .donate-info__body .donate-price li[data-price='5']",
                                ".donate .donate-info__body .donate-price li[data-price='10']"
                            ],
                            none: [
                                ".donate .donate-info__body .donate-price li[data-price='1']",
                                ".donate .donate-info__body .donate-price li a p.type-routine",
                                ".donate .donate-info__body .donate-divide-selector"
                            ]
                        })
                        document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                            _input.disabled = true;
                        })
                        break;

                    case "분할납부":

                        if (screenWidth > 769)
                        {
                            handleDisplayChange({
                                flex: [
                                    ".donate .donate-info__body .donate-price li[data-price='3']",
                                    ".donate .donate-info__body .donate-price li[data-price='5']",
                                    ".donate .donate-info__body .donate-price li[data-price='10']",
                                    ".donate .donate-info__body .donate-divide-selector"
                                ],
                                none: [
                                    ".donate .donate-info__body .donate-price li[data-price='1']",
                                    ".donate .donate-info__body .donate-price li a p.type-routine"
                                ]
                            });
                        }
                        else
                        {
                            handleDisplayChange({
                                flex: [
                                    ".donate .donate-info__body .donate-price li[data-price='3']",
                                    ".donate .donate-info__body .donate-price li[data-price='5']",
                                    ".donate .donate-info__body .donate-price li[data-price='10']",
                                ],
                                block: [
                                    ".donate .donate-info__body .donate-divide-selector"
                                ],
                                none: [
                                    ".donate .donate-info__body .donate-price li[data-price='1']",
                                    ".donate .donate-info__body .donate-price li a p.type-routine"
                                ]
                            });
                        }

                        document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                            _input.disabled = false;
                        })
                        setDonateDivide();
                        break;

                }

            }
        })

        const $donatePriceInput = document.querySelector("input[name='donation_price']");

        // 1만원, 3만원, 5만원 클릭 이벤트
        const addDonatePrice = document.querySelectorAll(".donate .donate-info__body .donate-price li a");
        const fixing_check = document.getElementById("fixing_check").value;
        addDonatePrice.forEach(function(i) {

            i.onclick = function (e) {

                e.preventDefault();

                if (fixing_check == 1) {
                    alert("기부금액이 지정된 프로그램입니다.");
                    return;
                }

                const price = Number(i.dataset.price) * 10000;
                // let _price = Number(extractOnlyNumbers($donatePriceInput.value));
                $donatePriceInput.value = (price).toLocaleString() + " 원";
                setDonateDivide()

            }
        });


        // 분할납부 +, - 하기
        const dividerCalculate = document.querySelectorAll(".input-calc-button");

        dividerCalculate.forEach(function (i) {

            i.onclick = function () {
                const _type = this.dataset.calc;
                const donatePrice = Number(extractOnlyNumbers(document.querySelector("input[name='donation_price']").value));
                let dividerCount = Number(extractOnlyNumbers(document.querySelector("input[name='divide_count']").value));

                if (_type === "+") {
                    dividerCount++;
                } else if (_type === "-") {
                    if (dividerCount == 1) return false;
                    dividerCount--;
                }

                document.querySelector("input[name='divide_count']").value = dividerCount;

                setDonateDivide(donatePrice, document.querySelector("input[name='divide_count']").value);
            }

        });


        // 분할납부 계산 함수
        function setDonateDivide()
        {
            let price = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document.querySelector('input[name="donation_price"]').value;
            let count = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 10;

            if (typeof price != "number") {
                price = extractOnlyNumbers(price);
            }

            if (typeof count != "number") {
                count = extractOnlyNumbers(count);
            }

            const divideCount = document.querySelector("input[name='divide_count']");
            const dividePrice = document.querySelector("input[name='divide_price']");
            const divideNotice = document.querySelector("span#divideNotice");
            divideCount.value = count + "회";
            dividePrice.value = Math.round(price / count).toLocaleString() + " 원";
            divideNotice.innerHTML = count + "개월 간 매달";
        }


        // 기부자 타입 선택
        const donatorSelector = document.querySelectorAll(".donate .donator-info__body .donator-type li a");
        donatorSelector.forEach (function (i) {
            i.onclick = function (e) {
                e.preventDefault();
                const _focused = document.querySelector(".donate .donator-info__body .donator-type li.on");
                if (_focused) {
                    _focused.classList.remove("on");
                }
                i.parentNode.classList.add("on")
                const _type = i.dataset.type;
                const donator_type = document.querySelector("input[name='donator_type']");
                donator_type.value = _type;

                switch (_type)
                {
                    case "개인":
                        document.querySelector(".anony-hide").style.display = "block";
                        document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                            if ($input.name != "course" && $input.name != "enter_year") {
                                $input.disabled = false;
                            } else {
                                $input.parentNode.style.display = "none";
                                $input.disabled = true;
                            }
                            if ($input.name == "relationship") {
                                $input.value = "";
                            }
                        })
                        document.querySelector("span.label-input-name").innerHTML = "성명";
                        document.querySelector("span.label-input-rsno").innerHTML = "주민등록번호";
                        break;
                    case "법인":
                        document.querySelector(".anony-hide").style.display = "block";
                        document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                            if ($input.name != "course" && $input.name != "enter_year") {
                                $input.disabled = false;
                            } else {
                                $input.parentNode.style.display = "none";
                                $input.disabled = true;
                            }
                            if ($input.name == "relationship") {
                                $input.value = "";
                            }
                        })
                        document.querySelector("span.label-input-name").innerHTML = "법인명";
                        document.querySelector("span.label-input-rsno").innerHTML = "사업자등록번호";
                        break;
                    case "익명":
                        document.querySelector(".anony-hide").style.display = "none";
                        document.querySelectorAll(".anony-hide input, .anony-hide select").forEach (function ($input) {
                            $input.disabled = true;
                        });
                        break;
                }

            }
        })

        // 결제방법 선택자
        const creditCardInputWrap = document.querySelector(".creditcard-show");
        const automaticInputWrap = document.querySelector(".automatic-show");
        const paymentType = document.querySelectorAll(".donate .donate-payment-body ul li a");
        paymentType.forEach (function (i) {

            i.onclick = function (e) {
                e.preventDefault();

                const _focused = document.querySelector(".donate .donate-payment-body ul li.on")
                if(_focused) {
                    _focused.classList.remove("on");
                }
                i.parentNode.classList.add('on');
                const _type = this.dataset.type;
                const input_payment_type = document.querySelector("input[name='payment_type']");
                input_payment_type.value = _type;

                switch (_type)
                {
                    case "자동이체":
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "block";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = false;
                        });
                        break;
                    case "무통장입금":
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "신용카드":
                        creditCardInputWrap.style.display = "block";
                        automaticInputWrap.style.display = "none";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = false;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "카카오페이":
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "네이버페이":
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    default: break;
                }
            }

        })


        // 자동이체 날짜 선택하기
        const automatic_transfer_assign = document.querySelectorAll("#automatic_transfer_assign li")
        const automatic_transfer_assign_day = document.querySelector("input[name='automatic_transfer_assign_day']")

        automatic_transfer_assign.forEach(function (dom) {

            dom.onclick = function (e) {

                e.preventDefault();

                const day = dom.dataset.day;
                if (!day) return false;

                const focus_day = document.querySelector("#automatic_transfer_assign li.on");
                if (focus_day) {
                    focus_day.classList.remove("on");
                }


                automatic_transfer_assign_day.value = day;

                dom.classList.add("on");
            }

        })


        const donation_price = document.querySelector("input[name='donation_price']");

        donation_price.addEventListener("input", function () {
            // alert("직접 입력할 수 없습니다");
            // this.value = "";
            // return false;
        })

        const relationship = document.querySelector("#relationship");
        const enterYearWrapper = document.querySelector("#enter_year_wrapper");
        const course_wrapper = document.querySelector("#course_wrapper");

        relationship.addEventListener("change", function () {
            if (this.value == "동문") {
                enterYearWrapper.querySelector("select").disabled = false;
                enterYearWrapper.style.display = "block";
                course_wrapper.querySelector("input").disabled = false;
                course_wrapper.style.display = "block";
            } else {
                enterYearWrapper.querySelector("select").disabled = true;
                enterYearWrapper.style.display = "none";
                course_wrapper.querySelector("input").disabled = true;
                course_wrapper.style.display = "none";
            }
        })


        // 납입방법이 5개라면 flex 때문에 정렬이 이상해짐. 수정해줌
        document.addEventListener("DOMContentLoaded", function () {
            if (document.querySelectorAll("#paymentTypes li")) {
                const $li = document.createElement("li");
                $li.style.border = "none";
                document.querySelector("#paymentTypes").appendChild($li);
            }

            const donation_price = Number(document.querySelector("input[name='donation_price']").value.replace(/,/g, ""));
            const lWidth = window.screen.width

            if (donation_price >= 5000000 && lWidth > 768) {
                document.querySelector(".warning-msg").style.display = "inline-block";
                document.querySelector(".divide-input").classList.add("type-required-warning")
            }
        })

    </script>


@endsection
