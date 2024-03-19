@extends("layouts/layout")

@section("title")
    명예의 전당 - 목록
@endsection

@push("scripts")

@endpush

@section("content")
    <div id="cz">
        <section id="common-content">
            <div class="common-wrap">
                <div id="main-block">
                    <div class="fame-title-sector">
                        <h2>기부자 라운지</h2>
                        <p>지역을 품고 세계와 함께하는 명문사학</p>
                    </div>
                </div>
                <div id="fame-view">
                    <div class="common-content-wrap">

                        @include("_include.lounge.sub")

                        <div id="legend-top-three">
                            <div class="legend-wrap">
                                <h3><span class="circle-icon"></span>명예의 전당 등재</h3>
                                <div class="legend-list">
                                    <div class="legend-content">
                                        <img class="legend-image" src="/img/fame_01.png" alt="">
                                        <p class="legend-subject">50억원 이상</p>
                                        <p class="legend-text">캠퍼스 내 흉상 설치</p>
                                    </div>
                                    <div class="legend-content">
                                        <img class="legend-image" src="/img/fame_02.png" alt="">
                                        <p class="legend-subject">10억원 이상</p>
                                        <p class="legend-text">대학본부 도너스 월 존영부조 등재</p>
                                    </div>
                                    <div class="legend-content">
                                        <img class="legend-image" src="/img/fame_03.png" alt="">
                                        <p class="legend-subject">5억원 이상</p>
                                        <p class="legend-text">대학본부 도너스 월 명패 등재</p>
                                    </div>
                                    <div class="legend-content">
                                        <img class="legend-image" src="/img/fame_03.png" alt="">
                                        <p class="legend-subject">1억원 이상</p>
                                        <p class="legend-text">대학본부 도너스 월 명패 등재</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="fame-table-wrap">
                            <div id="fame-table-list">
                                <h3><i class="circle-icon"></i>예우혜택</h3>
                                <div id="table-all-wrap">
                                    <table class="fame-table table-01">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-funnel-dollar"></i>
                                                동아대학교병원<br> 진료비 감면 (본인,배우자)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">100억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">30억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">10억 원 이상</td>
                                            <td class="donation-benefits">60% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5억 원 이상</td>
                                            <td class="donation-benefits">50% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3억 원 이상</td>
                                            <td class="donation-benefits">40% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">30% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">6천만 원 이상</td>
                                            <td class="donation-benefits">20% 감면</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="fame-table table-02">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-user-md"></i>
                                                동아대학교병원<br> 연 1회 종합검진 (본인, 배우자)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">100억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">30억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">10억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="fame-table table-03">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-procedures"></i>
                                                동아대학교병원<br> 외래/입원 우선권
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">100억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">30억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">10억 원 이상</td>
                                            <td class="donation-benefits">60% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5억 원 이상</td>
                                            <td class="donation-benefits">50% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3억 원 이상</td>
                                            <td class="donation-benefits">40% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">30% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">6천만 원 이상</td>
                                            <td class="donation-benefits">20% 감면</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="fame-table table-04">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-hospital-user"></i>
                                                동아대학교병원<br> 장례식장 이용료 감면 (본인, 배우자)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">100억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">30억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">10억 원 이상</td>
                                            <td class="donation-benefits">60% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5억 원 이상</td>
                                            <td class="donation-benefits">50% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3억 원 이상</td>
                                            <td class="donation-benefits">30% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">30% 감면</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="fame-table table-05">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-hospital-user"></i>
                                                동아대학교병원<br> 장례식장 이용료 감면 (직계존속)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">100억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">50억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">10억 원 이상</td>
                                            <td class="donation-benefits">50% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5억 원 이상</td>
                                            <td class="donation-benefits">30% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3억 원 이상</td>
                                            <td class="donation-benefits">20% 감면</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">20% 감면</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="fame-table table-06">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-school"></i>
                                                동아대학교<br> 평생교육원 수강료 할인
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="donation-level">1억 원 이상</td>
                                            <td class="donation-benefits">무료</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">5천만 원 이상</td>
                                            <td class="donation-benefits">50% 할인</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">3천만 원 이상</td>
                                            <td class="donation-benefits">30% 할인</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="fame-info-wrap">
                                <p><i class="fa fa-clipboard-check"></i>진료비 감면은 진료재료, 치과재료, 약제비, 식대 및 병상료를 제외한 금액 기준입니다.</p>
                                <p><i class="fa fa-clipboard-check"></i>병실료는 1인실은 30%, 1인실 초과 상급병실은 40% 감면됩니다.</p>
                                <p><i class="fa fa-clipboard-check"></i>장례식장 이용료 감면은 빈소사용료, 안치료, 염습비, 영결식장 사용료, 쓰레기 처리비용이 포함되며 장례용품은 포함되지 않습니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include("_include.donate")
    </div>
@endsection
