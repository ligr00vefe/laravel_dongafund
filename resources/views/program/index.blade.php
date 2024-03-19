@extends("layouts/layout")

@section("title")
    기부 프로그램 - 대학발전 전반 지원
@endsection

@push("scripts")

@endpush

@section("content")


    {{--

    안쓰는 페이지

    --}}

    <div class="m-top-150"></div>

{{--    <div class="container long">--}}

{{--        <div class="program-support swp-row-100-white">--}}

{{--            <div class="col1 over-hidden">--}}
{{--                <div class="row1 float-left">--}}
{{--                    <img src="/img/program_intro.png" alt="당신이 만드는 동아의 역사">--}}
{{--                </div>--}}

{{--                <div class="row2 float-left">--}}

{{--                    <div class="row-head">--}}
{{--                        <h2 class="ff-ibm-bold">STEP 1. 약정정보</h2>--}}
{{--                    </div>--}}

{{--                    <div class="row-content">--}}

{{--                        <div class="fund-selector-wrap">--}}
{{--                            <label for="fundTypeSelector">기부 프로그램</label>--}}
{{--                            <select name="" id="fundTypeSelector">--}}
{{--                                <option value="">기부 프로그램 선택</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="m-top-10">--}}
{{--                            <a href="#" class="before-mark-blue-quest">--}}
{{--                                너무 많아서 잘 모르시겠나요?--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="content-selector m-top-20">--}}
{{--                            <ul id="fundSelector" class="fund-selector-tab">--}}
{{--                                <li class="on" data-type="정기기부">--}}
{{--                                    <a href="#">정기기부</a>--}}
{{--                                </li>--}}
{{--                                <li data-type="일시기부">--}}
{{--                                    <a href="#">일시기부</a>--}}
{{--                                </li>--}}
{{--                                <li data-type="분할납부">--}}
{{--                                    <a href="#">분할납부</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                        <div class="fund-changer">--}}

{{--                            <form action="">--}}
{{--                                <input type="hidden" name="fund_type" value="정기기부">--}}
{{--                                <input type="hidden" name="fund_cycle" value="10">--}}
{{--                                <input type="hidden" name="donator_type" value="개인">--}}
{{--                                <input type="hidden" name="payment_type" value="자동이체">--}}

{{--                                <div class="step1">--}}
{{--                                    <ul id="fundCycleSelector" class="tabmenu-2">--}}
{{--                                        <li class="on" data-cycle="10">--}}
{{--                                            <a href="#">--}}
{{--                                                매월 10일--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li data-cycle="25">--}}
{{--                                            <a href="#">--}}
{{--                                                매월 25일--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}

{{--                                    <div class="added-fund-prices-wrap">--}}

{{--                                        <ul id="fundPriceAdd" class="dis-ib">--}}
{{--                                            <li data-price="30000">--}}
{{--                                                <a href="#">--}}
{{--                                                    + 3만원--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li data-price="50000">--}}
{{--                                                <a href="#">--}}
{{--                                                    + 5만원--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li data-price="100000">--}}
{{--                                                <a href="#">--}}
{{--                                                    + 10만원--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}

{{--                                    </div>--}}

{{--                                    <div class="fund-price-wrap">--}}
{{--                                        <label for="fundPrice">기부금액</label>--}}
{{--                                        <div class="row">--}}
{{--                                            <input type="text" name="fundPrice" id="fundPrice" value="300000"> 원--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="step2">--}}

{{--                                    <div class="head">--}}
{{--                                        <h2>STEP 2. 기부자정보</h2>--}}
{{--                                    </div>--}}

{{--                                    <div class="tab-wrap m-top-20">--}}
{{--                                        <ul id="donatorTypeSelector" class="tabmenu-3">--}}
{{--                                            <li class="on" data-donator="개인">--}}
{{--                                                <a href="#">--}}
{{--                                                    개인--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li data-donator="법인사업자">--}}
{{--                                                <a href="#">--}}
{{--                                                    법인사업자--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li data-donator="익명">--}}
{{--                                                <a href="#">--}}
{{--                                                    익명--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}

{{--                                    <div id="donatorInformation" class="personal">--}}

{{--                                        <div class="input-wrap">--}}
{{--                                            <label for="personal_name">이름(기관명)</label>--}}
{{--                                            <div class="row">--}}
{{--                                                <input type="text" name="name" id="personal_name" placeholder="실명을 기입하세요">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="input-wrap">--}}
{{--                                            <label for="personal_rsNo">주민등록번호(기부금 영수증 발급용)</label>--}}
{{--                                            <div class="row">--}}
{{--                                                <input type="text" name="rsNo" id="personal_rsNo" placeholder="ex. 000000-0000000">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="input-wrap">--}}
{{--                                            <label for="personal_tel">연락처</label>--}}
{{--                                            <div class="row">--}}
{{--                                                <input type="text" name="tel" id="personal_tel" placeholder="ex. 000-0000-0000">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="address-input-wrap">--}}
{{--                                            <input type="text" name="address1" class="address1">--}}
{{--                                            <a href="#" class="address-find">주소 검색</a>--}}
{{--                                        </div>--}}

{{--                                        <div class="normal-input-100">--}}
{{--                                            <input type="text" name="address2" placeholder="주소">--}}
{{--                                        </div>--}}

{{--                                        <div class="normal-input-100">--}}
{{--                                            <input type="text" name="address3" placeholder="상세주소">--}}
{{--                                        </div>--}}

{{--                                        <div class="company-hide">--}}
{{--                                            <div class="input-wrap">--}}
{{--                                                <label for="relationship">학교와의 관계</label>--}}
{{--                                                <div class="row">--}}
{{--                                                    <select name="relationship" id="relationship">--}}
{{--                                                        <option value="">선택하세요</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="input-wrap">--}}
{{--                                                <label for="enterYear">입학연도</label>--}}
{{--                                                <div class="row">--}}
{{--                                                    <select name="enterYear" id="enterYear">--}}
{{--                                                        <option value="">선택하세요</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="input-wrap">--}}
{{--                                                <label for="department_and_course">학과/과정</label>--}}
{{--                                                <div class="row">--}}
{{--                                                    <input type="text" name="department_and_course" id="department_and_course" placeholder="학과/이수과정을 입력해주세요">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="step3">--}}

{{--                                    <div class="head">--}}
{{--                                        <h2>STEP 3. 납입방법</h2>--}}
{{--                                    </div>--}}

{{--                                    <div class="tab-wrap m-top-20">--}}
{{--                                        <ul id="paymentTypeSelector" class="tabmenu-3">--}}
{{--                                            <li class="on" data-type="자동이체">--}}
{{--                                                <a href="#">--}}
{{--                                                    자동이체--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="typeOnce" data-type="신용카드">--}}
{{--                                                <a href="#">--}}
{{--                                                    신용카드--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="typeOnce" data-type="카카오">--}}
{{--                                                <a href="#">--}}
{{--                                                    <img src="/img/icon_kakao.png" alt="카카오">--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="typeOnce" data-type="네이버페이">--}}
{{--                                                <a href="#">--}}
{{--                                                    <img src="/img/icon_naverpay.png" alt="네이버페이">--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="" data-type="급여공제">--}}
{{--                                                <a href="#">--}}
{{--                                                    급여공제--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="">--}}

{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-wrap">--}}
{{--                                        <label for="bank_name">은행명</label>--}}
{{--                                        <div class="row">--}}
{{--                                            <select name="bank_name" id="bank_name">--}}
{{--                                                <option value="">선택하세요</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-wrap">--}}
{{--                                        <label for="bank_account_number">계좌번호</label>--}}
{{--                                        <div class="row">--}}
{{--                                            <input type="text" name="bank_account_number" id="bank_account_number" placeholder="계좌번호를 입력하세요">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-wrap">--}}
{{--                                        <label for="bank_account_holder">예금주</label>--}}
{{--                                        <div class="row">--}}
{{--                                            <input type="text" name="bank_account_holder" id="bank_account_holder" placeholder="실명을 기입하세요">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="step4">--}}
{{--                                    <div class="head">--}}
{{--                                        <h2>--}}
{{--                                            STEP 4. 개인정보 수집·이용에 관한 동의--}}
{{--                                        </h2>--}}
{{--                                    </div>--}}

{{--                                    <div class="check-all-wrap">--}}
{{--                                        <input type="checkbox" name="check_all" id="check_all">--}}
{{--                                        <label for="check_all">전체동의(선택 항목 포함)</label>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-check-wrap">--}}
{{--                                        <div class="row m-bottom-15">--}}
{{--                                            <ul class="dis-ib">--}}
{{--                                                <li>--}}
{{--                                                    <input type="checkbox" name="required_info_check" id="required_info_check" >--}}
{{--                                                    <label for="required_info_check"></label>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <p>필수수집정보</p>--}}
{{--                                                    <a href="#">기부금 영수증 발급을 위해 필요한 정보</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <div class="row border-box">--}}
{{--                                            <table>--}}
{{--                                                <tr>--}}
{{--                                                    <th>--}}
{{--                                                        필수수집정보--}}
{{--                                                    </th>--}}
{{--                                                    <td>--}}
{{--                                                        기부금 영수증 발급, 기부자 예우를 위한--}}
{{--                                                        필수 정보--}}
{{--                                                        <br>--}}
{{--                                                        <span>성명, 주민등록번호, 연락처, 주소, 약정--}}
{{--                                                        금액, 납입방법</span>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-check-wrap">--}}
{{--                                        <div class="row">--}}
{{--                                            <ul class="dis-ib">--}}
{{--                                                <li>--}}
{{--                                                    <input type="checkbox" name="optional_info_check" id="optional_info_check" >--}}
{{--                                                    <label for="optional_info_check"></label>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <p>선택수집정보</p>--}}
{{--                                                    <a href="#">기부자 예우혜택 제공을 위해 필요한 정보</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="input-check-wrap">--}}
{{--                                        <div class="row">--}}
{{--                                            <ul class="dis-ib">--}}
{{--                                                <li>--}}
{{--                                                    <input type="checkbox" name="third_party_check" id="third_party_check" >--}}
{{--                                                    <label for="third_party_check"></label>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <p>제 3자 제공동의</p>--}}
{{--                                                    <a href="#">기부금 납입을 위한 결제정보 제공</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </form>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}






@endsection
