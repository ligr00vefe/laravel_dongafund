@extends("layouts/layout")

@section("title")
    대학발전 전반 지원
@endsection

@push("scripts")
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
@endpush

@section("content")

    <div class="pageWrapper"
    style="width: 100vw; height: 100vh; position: fixed; z-index:99999; background-color: rgba(0,0,0,0.5); display: none;"
    ></div>

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

                <div class="donate-form__top border-shadow">

                    <div class="donate-form__top-head">
                        <i class="fa fa-running"></i> <span class="dot-orange-bottom"></span>
                        <div class="dis-ib">
                            <h3>{{ $program->subject ?? "" }}</h3><span>에 기부</span>
                        </div>
                    </div>

                    <div class="donate-form__top-body">
                        <p>
                            {{ strip_tags($program->contents) ?? "" }}
                        </p>
                    </div>

                    <div class="donate-form__top-bottom">
                        <a href="/support?type=campaign">
                            <i class="fa fa-search"></i>
                            <span>기부 프로그램 살펴보기</span>
                        </a>
                    </div>

                </div>


                <div class="donate-form__body">

                    <form action="/donate" method="post" onsubmit="return validate(this)">
                        @csrf
                        <input type="hidden" name="host" value="{{ $host }}">
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" id="fixing_check" name="fixing_check" value="{{ $program->fixing_check }}">
                        <input type="hidden" id="donation_type" name="donation_type" value="">
                        <input type="hidden" id="donator_type" name="donator_type" value="개인">
                        <input type="hidden" id="payment_type" name="payment_type" value="">
                        <input type="hidden" name="automatic_transfer_assign_day" value="">


                        <div class="donate-info border-shadow">

                        <div class="donate-info__head">

                            <h3>
                                1 <span class="dot-orange-bottom"></span> 기부정보
                            </h3>

                            <div class="donate-question">
                                <a href="#">
                                    <i class="fa fa-question-circle"></i>
                                    <span>
                                        복잡해서 어려움을 겪고 계신가요?
                                    </span>
                                </a>
                                <div class="modal-small">
                                    <p>
                                        대외협력처로 전화주시면 상세히 안내드리겠습니다.
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i> 051-200-6012
                                    </p>
                                    <p class="bottom-detail">
                                        자세히 보기
                                        <i class="fa fa-chevron-right"></i>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="donate-info__body">

                            <ul id="donateTypes" class="donate-types">
                                <li>
                                    <a href="#" data-type="정기기부" data-use="{{ $program->donation_type1 == "1" ? "true" : "false" }}">정기기부</a>
                                </li>
                                <li>
                                    <a href="#" data-type="일시기부" data-use="{{ $program->donation_type2 == "1" ? "true" : "false" }}">일시기부</a>
                                </li>
                                <li>
                                    <a href="#" data-type="분할납부" data-use="{{ $program->donation_type3 == "1" ? "true" : "false" }}">분할납부</a>
                                </li>
                            </ul>

                            <ul class="donate-price">
                                <li class="flex-center" data-price="1">
                                    <a href="#" type="button" data-price="1" class="">
                                        <p class="type-routine">매달</p>
                                        <p>1만원</p>
                                    </a>
                                </li>
                                <li class="flex-center" data-price="3">
                                    <a href="#" type="button" data-price="3">
                                        <p class="type-routine">매달</p>
                                        <p>3만원</p>
                                    </a>
                                </li>
                                <li class="flex-center" data-price="5">
                                    <a href="#" type="button" data-price="5">
                                        <p class="type-routine">매달</p>
                                        <p>5만원</p>
                                    </a>
                                </li>
                                <li class="flex-center" data-price="10">
                                    <a href="#" type="button" data-price="10">
                                        <p class="type-routine">매달</p>
                                        <p>10만원</p>
                                    </a>
                                </li>
                                <li class="price-input-wrap custom" data-visible="routine">
                                    <div class="divide-input">
                                        <input type="text" name="donation_price" class="donate_price" value="{{ issetNumberFormat($program->fixing_price ?? 0) }}"
                                        {{ $program->fixing_price != "" ? "readonly" : "" }}
                                        >
                                    </div>
                                    <p class="warning-msg donation_price_msg">
                                        신용카드는 500만원 미만의 결제가 가능합니다.
                                    </p>
                                </li>

                            </ul>

                            <ul class="donate-divide-selector">

                                <li class="input-wrap-top-msg">
                                    <span class="top-msg">
                                        분할횟수
                                    </span>
                                    <div class="input-plus-minus-wrap">
                                        <button type="button" id="priceAdd" class="input-calc-button" data-calc="+">+</button>
                                        <input type="text" name="divide_count" readonly value="10회">
                                        <button type="button" id="priceSub" class="input-calc-button" data-calc="-">-</button>
                                    </div>
                                </li>

                                <li class="input-wrap-top-msg">
                                    <span class="top-msg">
                                        월 기부금액
                                    </span>
                                    <div class="input-divider-wrap">
                                        <span id="divideNotice">개월 간 매달</span>
                                        <input type="text" name="divide_price" readonly value="">
                                    </div>

                                </li>

                            </ul>

                        </div>

                    </div>


                    <div class="donator-info border-shadow">

                        <div class="donator-info__head">

                            <h3>
                                2 <span class="dot-orange-bottom"></span> 기부자 정보
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
                                        <input type="text" id="rsno" name="rsno" value="">
                                        <input type="password" id="rsno2" name="rsno2" value="">
                                        <input type="hidden" id="regNumber" name="regNumber" value="">
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

                    <div class="donate-payment border-shadow">

                        <div class="donate-payment__head">

                            <h3>
                                3 <span class="dot-orange-bottom"></span> 납입방법
                            </h3>

                        </div>

                        <div class="donate-payment-body">

                            <ul id="paymentTypes" class="payment-types">

                                @if (strContain($program->payment_method ?? "", "무통장입금"))
                                    <li>
                                        <a href="#" data-type="무통장입금">
                                            무통장입금
                                        </a>
                                    </li>
                                @endif

                                @if (strContain($program->payment_method ?? "", "자동이체"))
                                    <li>
                                        <a href="#" data-type="자동이체">
                                            자동이체
                                        </a>
                                    </li>
                                @endif

                                @if (strContain($program->payment_method ?? "", "신용카드"))
                                    <li>
                                        <a href="#" data-type="신용카드">
                                            신용카드
                                        </a>
                                    </li>
                                @endif

                                @if (strContain($program->payment_method ?? "", "카카오페이"))
                                    <li>
                                        <a href="#" data-type="카카오페이">
                                            <img src="/img/kakaopay.png" alt="카카오페이">
                                        </a>
                                    </li>
                                @endif

                                @if (strContain($program->payment_method ?? "", "네이버페이"))
                                    <li>
                                        <a href="#" data-type="네이버페이">
                                            <img src="/img/naverpay.png" alt="네이버페이">
                                        </a>
                                    </li>
                                @endif

                            </ul>

                        </div>

                        <div class="automatic-show">

                            <ul class="type-selector transfer_day_assign">
                                <li class="" data-day="25">
                                    <a href="#" >
                                        <p>매달 25일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li data-day="10">
                                    <a href="#" >
                                        <p>매달 10일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li class="border-none"></li>
                            </ul>

                            <ul class="ul-flex">

                                <li class="select-wrap select-wrap--type-small type-required">
                                    <select id="automatic_bank_name" class="arrow-hide" name="automatic_bank_name" disabled>
                                        <option value="" hidden>은행명</option>
                                        <option value="산업은행">산업은행</option>
                                        <option value="기업은행">기업은행</option>
                                        <option value="국민은행">국민은행</option>
                                        <option value="수협중앙회">수협중앙회</option>
                                        <option value="농협은행">농협은행</option>
                                        <option value="지역농축협">지역농축협</option>
                                        <option value="우리은행">우리은행</option>
                                        <option value="SC은행">SC은행</option>
                                        <option value="한국씨티은행">한국씨티은행</option>
                                        <option value="대구은행">대구은행</option>
                                        <option value="부산은행">부산은행</option>
                                        <option value="광주은행">광주은행</option>
                                        <option value="제주은행">제주은행</option>
                                        <option value="전북은행">전북은행</option>
                                        <option value="경남은행">경남은행</option>
                                        <option value="새마을금고연합회">새마을금고연합회</option>
                                        <option value="신협">신협</option>
                                        <option value="저축은행">저축은행</option>
                                        <option value="HSBC은행">HSBC은행</option>
                                        <option value="도이치은행">도이치은행</option>
                                        <option value="JP모간체이스은행">JP모간체이스은행</option>
                                        <option value="BOA은행">BOA은행</option>
                                        <option value="BNP파리바은행">BNP파리바은행</option>
                                        <option value="중국공상은행">중국공상은행</option>
                                        <option value="산림조합">산림조합</option>
                                        <option value="중국건설은행">중국건설은행</option>
                                        <option value="우체국">우체국</option>
                                        <option value="하나은행">하나은행</option>
                                        <option value="신한은행">신한은행</option>
                                        <option value="케이뱅크">케이뱅크</option>
                                        <option value="카카오뱅크">카카오뱅크</option>
                                    </select>
                                    <i class="fa fa-chevron-down"></i>
                                </li>

                                <li class="swp-input-wrap type-required">
                                    <span class="label-input-name">계좌번호</span>
                                    <input type="text" name="automatic_bank_number" value="" autocomplete="off" disabled>
                                </li>

                            </ul>
                        </div>

                        <div class="creditcard-show">

                            <ul class="type-selector transfer_day_assign">
                                <li class="" data-day="25">
                                    <a href="#" >
                                        <p>매달 25일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li data-day="10">
                                    <a href="#" >
                                        <p>매달 10일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li class="border-none"></li>
                            </ul>

                            <ul>

                                <li class="swp-input-wrap type-required">
                                    <span class="label-input-name">카드번호</span>
                                    <input type="text" name="credit_card_number" value="" autocomplete="off" disabled>
                                </li>

                                <li class="swp-input-wrap type-required">
                                    <span class="label-input-name">유효기간 (YY/MM)</span>
                                    <input type="text" name="credit_card_expiration" value="" autocomplete="off" disabled>
                                </li>

                            </ul>
                        </div>


                        <div class="kakaopay-show">
                            <ul class="type-selector transfer_day_assign">
                                <li class="" data-day="25">
                                    <a href="#" >
                                        <p>매달 25일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li data-day="10">
                                    <a href="#" >
                                        <p>매달 10일</p>
                                        <p>자동이체</p>
                                    </a>
                                </li>
                                <li class="border-none"></li>
                            </ul>
                        </div>

                    </div>

                    <div class="donate-agree border-shadow">
                        <div class="donate-agree__head">

                            <h3>
                                4 <span class="dot-orange-bottom"></span> 개인정보 수집·이용 및 제3자 제공 동의
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


        document.getElementById("rsno").addEventListener("keyup", function () {
            let _val = this.value;

            if (_val.length > 5) {
                document.getElementById("rsno2").focus();
            }

            document.getElementById("regNumber").value = document.getElementById("rsno").value + document.getElementById("rsno2").value;
        })


        document.getElementById("rsno2").addEventListener("click", function () {
            if (document.getElementById("rsno").value == "") {
                document.getElementById("rsno").focus();
            }
        })


        document.getElementById("rsno2").addEventListener("keyup", function () {
            document.getElementById("regNumber").value = document.getElementById("rsno").value + document.getElementById("rsno2").value;
        })


        // 자동이체일때 예금주 조회 실행
        function callPopbillAccountCheck(bankName, bankNumber)
        {
            return axios.post("/donate/popbill/check", {
                bankName: bankName,
                bankNumber: bankNumber
            })
        }

        // 자동이체일때 비동기로 추가하기
        function asyncDonation(f)
        {
            const params = {
                program_id: f.program_id.value,
                donation_type: f.donation_type.value,
                donation_price: f.donation_price.value,
                divide_count: f.divide_count.value ? f.divide_count.value : 0,
                divide_price: f.divide_price.value ? f.divide_price.value : 0,
                donator_type: f.donator_type.value ? f.donator_type.value : null,
                name: f.name.value ? f.name.value : null,
                tel: f.tel.value ? f.tel.value : null,
                regNumber: f.regNumber.value ? f.regNumber.value : null,
                zipcode: f.zipcode.value ? f.zipcode.value : null,
                address1: f.address1.value ? f.address1.value : null,
                address2: f.address2.value ? f.address2.value : null,
                relationship: f.relationship.value ? f.relationship.value : null,
                enter_year: f.enter_year.value ? f.enter_year.value : null,
                course: f.course.value ? f.course.value : null,
                payment_type: f.payment_type.value ? f.payment_type.value : null,
                credit_card_number: f.credit_card_number.value ? f.credit_card_number.value : null,
                credit_card_expiration : f.credit_card_expiration.value ? f.credit_card_expiration.value : null,
                automatic_transfer_assign_day: f.automatic_transfer_assign_day.value ? f.automatic_transfer_assign_day.value : null,
                automatic_bank_name: f.automatic_bank_name.value ? f.automatic_bank_name.value : null,
                automatic_bank_number: f.automatic_bank_number.value ? f.automatic_bank_number.value : null,
                receipt_check: f.receipt_check.value ? f.receipt_check.value : null,
                benefit_check: f.benefit_check.value ? f.benefit_check.value : null,
                tax_check: f.tax_check.value ? f.tax_check.value : null,
            };

            return axios.post("/async/donate/add", params)
        }





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

                if (key == "donation_type" && f[key].value == "일시기부") {
                    f[automatic_transfer_assign_day].disabled = true;
                }

                if (f[key].disabled) {
                    f[key].value = "";
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

            // 자동이체면 예금주조회 -> 비동기
            if (f.payment_type.value == "자동이체") {

                const pageWrapper = document.querySelector(".pageWrapper");
                pageWrapper.style.display = "block";

                let data = {};

                callPopbillAccountCheck(f.automatic_bank_name.value, f.automatic_bank_number.value)
                .then(function (response) {
                    data = response.data;
                    if (data.resultCode != "0000") {
                        alert("예금주조회에 실패했습니다. " + data.resultMessage);
                        return false;
                    }

                    asyncDonation(f)
                    .then(function (donationResponse) {
                        if (donationResponse.data.code == 1) {
                            location.href = "/signature?id=" + donationResponse.data.data.id;
                        }

                    })
                })
                .catch(function (error) {
                    console.error("request is failed...");
                    alert("예금주조회에 실패했습니다.(테스트중이므로 실패시에도 넘어갑니다)")
                    asyncDonation(f)
                        .then(function (donationResponse) {
                            if (donationResponse.data.code == 1) {
                                location.href = "/signature?id=" + donationResponse.data.data.id;
                            }

                        })
                })
                .finally(function (fin) {
                    pageWrapper.style.display = "none";
                })

                return false;

            }


            // 자동이체가 아닐경우 별다른 검증 없이 true
            else {

                return true;

            }


            return false;

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

                document.querySelector("input[name='payment_type']").value = "";
                if (document.querySelector("ul#paymentTypes li.on")) {
                    document.querySelector("ul#paymentTypes li.on").classList.remove("on")
                }

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
                        document.querySelector("input[name='automatic_transfer_assign_day']").value = "";

                        if (document.querySelector("ul#paymentTypes li a[data-type='무통장입금']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='무통장입금']").parentNode.style.display = "none";
                        }
                        if (document.querySelector("ul#paymentTypes li a[data-type='자동이체']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='자동이체']").parentNode.style.display = "block";
                        }

                        handleDisplayChange({
                            block: [
                                ".donate .donate-info__body .donate-price li a p.type-routine"
                            ],
                            flex: [
                                ".donate .donate-info__body .donate-price li[data-price='1']",
                                ".donate .donate-info__body .donate-price li[data-price='3']",
                                ".donate .donate-info__body .donate-price li[data-price='10']",
                            ],
                            none: [
                                ".donate .donate-info__body .donate-price li[data-price='5']",
                                ".donate .donate-info__body .donate-divide-selector",
                                ".kakaopay-show", ".creditcard-show", ".automatic-show"
                            ]
                        })
                        document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                            _input.disabled = true;
                        })

                        break;

                    case "일시기부":
                        document.querySelector("input[name='automatic_transfer_assign_day']").value = "";
                        if (document.querySelector("ul#paymentTypes li a[data-type='무통장입금']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='무통장입금']").parentNode.style.display = "block";
                        }
                        if (document.querySelector("ul#paymentTypes li a[data-type='자동이체']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='자동이체']").parentNode.style.display = "none";
                        }

                        handleDisplayChange({
                            flex: [
                                ".donate .donate-info__body .donate-price li[data-price='3']",
                                ".donate .donate-info__body .donate-price li[data-price='5']",
                                ".donate .donate-info__body .donate-price li[data-price='10']"
                            ],
                            none: [
                                ".donate .donate-info__body .donate-price li[data-price='1']",
                                ".donate .donate-info__body .donate-price li a p.type-routine",
                                ".donate .donate-info__body .donate-divide-selector",
                                ".kakaopay-show", ".creditcard-show", ".automatic-show"
                            ]
                        })
                        document.querySelectorAll(".donate-divide-selector input").forEach(function (_input) {
                            _input.disabled = true;
                        })
                        break;

                    case "분할납부":
                        document.querySelector("input[name='automatic_transfer_assign_day']").value = "";
                        if (document.querySelector("ul#paymentTypes li a[data-type='무통장입금']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='무통장입금']").parentNode.style.display = "block";
                        }
                        if (document.querySelector("ul#paymentTypes li a[data-type='자동이체']")) {
                            document.querySelector("ul#paymentTypes li a[data-type='자동이체']").parentNode.style.display = "block";
                        }
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
                                    ".donate .donate-info__body .donate-price li a p.type-routine",
                                    ".kakaopay-show", ".creditcard-show", ".automatic-show"
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
                                    ".donate .donate-info__body .donate-price li a p.type-routine",
                                    ".kakaopay-show", ".creditcard-show", ".automatic-show"
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

        $donatePriceInput.addEventListener("change", function () {
            const _val = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            const price = (Number(_val)).toLocaleString();
            this.value = price + "원";

            if (Number(_val) >= 5000000) {
                document.querySelector(".donation_price_msg").style.display = "block";
            } else {
                document.querySelector(".donation_price_msg").style.display = "none";
            }
        })


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

                const rsno = document.getElementById("rsno");
                const rsno2 = document.getElementById("rsno2");
                const regNumber = document.getElementById("regNumber");

                rsno.value = "";
                rsno2.value = "";
                regNumber.value = "";

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
                        rsno.style.width = "65px";
                        rsno2.disabled = false;
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
                        rsno.style.width = "200px";
                        rsno2.disabled = true;
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
        const kakaopaySelectWrap = document.querySelector(".kakaopay-show");
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
                        kakaopaySelectWrap.style.display = "none";
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "block";
                        document.querySelector("input[name='automatic_transfer_assign_day']").disabled = false;
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = false;
                        });
                        break;
                    case "무통장입금":
                        kakaopaySelectWrap.style.display = "none";
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        document.querySelector("input[name='automatic_transfer_assign_day']").disabled = true;

                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "신용카드":
                        kakaopaySelectWrap.style.display = "none";
                        creditCardInputWrap.style.display = "block";
                        automaticInputWrap.style.display = "none";
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = false;
                        });

                        if (document.getElementById("donation_type").value == "일시기부") {
                            document.querySelector("input[name='automatic_transfer_assign_day']").disabled = true;
                            document.querySelector(".creditcard-show .type-selector").style.display = "none";
                        } else {
                            document.querySelector("input[name='automatic_transfer_assign_day']").disabled = false;
                            document.querySelector(".creditcard-show .type-selector").style.dispay = "flex";
                        }


                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "카카오페이":
                        kakaopaySelectWrap.style.display = "block";
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        document.querySelector("input[name='automatic_transfer_assign_day']").disabled = false;
                        creditCardInputWrap.querySelectorAll("input").forEach(function($input) {
                            $input.disabled = true;
                        });
                        automaticInputWrap.querySelectorAll("input, select").forEach(function($input) {
                            $input.disabled = true;
                        });
                        break;
                    case "네이버페이":
                        kakaopaySelectWrap.style.display = "none";
                        creditCardInputWrap.style.display = "none";
                        automaticInputWrap.style.display = "none";
                        document.querySelector("input[name='automatic_transfer_assign_day']").disabled = false;
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
        const automatic_transfer_assign = document.querySelectorAll("ul.transfer_day_assign li")
        const automatic_transfer_assign_day = document.querySelector("input[name='automatic_transfer_assign_day']")

        automatic_transfer_assign.forEach(function (dom) {

            dom.onclick = function (e) {

                e.preventDefault();

                if (document.querySelector("input[name='donation_type']").value === "일시기부") {
                    alert("일시기부에서는 사용하지 않습니다");
                    return;
                }

                const day = dom.dataset.day;
                if (!day) return false;

                const focus_day = dom.parentNode.querySelector("ul.transfer_day_assign li.on");
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
