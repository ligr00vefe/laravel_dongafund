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
                <div id="benefit-view">
                    <div class="common-content-wrap">

                        @include("_include.lounge.sub")

                        <div id="benefit-table-wrap">
                            <div id="benefit-table-list">
                                <h3><i class="circle-icon"></i>기부자별 세제 혜택</h3>
                                <div id="table-all-wrap">
                                    <table class="benefit-table table-01">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-user"></i>
                                                개인 기부자<br> (근로소득자)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="2" class="donation-level">
                                                <span class="deep-color">예시)</span><br> 연봉이 <span class="color-blue">1억 원</span>인 근로소득자가 <span class="color-blue">3천만 원</span>을 기부하셨을 경우
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level deep-color"><span class="deep-color">법정기부금 단체<br> (동아대학교)</span></td>
                                            <td class="donation-benefits"><span class="color-blue">750만 원 절감</span></td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">지정기부금 단체</td>
                                            <td class="donation-benefits">617만 원 절감</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">비인허가 단체</td>
                                            <td class="donation-benefits">절감 없음</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="donation-level info-text">
                                                개인 기부자께서는 연말정산 또는 종합소득세 신고시 연간 소득금액 100% 범위 내에서 기부금액의 15%(1천만원 초과분에 대해서는 30%)를 세액공제 받으실 수 있습니다.<br><br>
                                                동아대학교는 법정기부금 단체이므로 같은 금액을 기부하셔도 소득공제한도가 30%인 민간 지정기부금 단체 대비 더 많은 세제혜택을 받으실 수 있습니다.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="benefit-table table-02">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-user"></i>
                                                개인 기부자<br> (개인사업자)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="2" class="donation-level"><span class="deep-color">예시)</span><br> 매출이 <span class="color-blue">1억 원</span>, 비용이 3천만 원인 개인사업자가 <span class="color-blue">3천만 원</span>을 기부하셨을 경우</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level"><span class="deep-color">법정기부금 단체<br> (동아대학교)</span></td>
                                            <td class="donation-benefits"><span class="color-blue">666만 원 절감</span><br> 산출세액 492만 원</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">지정기부금 단체</td>
                                            <td class="donation-benefits">504만 원 절감<br> 산출세액 654만 원</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">비인허가 단체</td>
                                            <td class="donation-benefits">절감 없음<br> 산출세액 1,158만 원</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="donation-level info-text">개인사업자께서 동아대학교에 기부하시면 사업소득금액의 100% 범위 내에서 필요경비에 산입하거나 세액공제 받으실 수 있습니다.<br><br>
                                                동아대학교는 법정기부금 단체이므로 같은 금액을 기부하셔도 소득공제한도가 30%인 민간 지정기부금 단체 대비 더 많은 세제혜택을 받으실 수 있습니다.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="benefit-table table-03">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <i class="fa fa-building"></i>
                                                법인 기부자
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="2" class="donation-level"><span class="deep-color">예시)</span><br> 사업소득금액 <span class="color-blue">5억 원</span>인 법인사업자가 <span class="color-blue">2억 원</span> 을 기부하셨을 경우</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level"><span class="deep-color">법정기부금 단체<br> (동아대학교)</span></td>
                                            <td class="donation-benefits"><span class="color-blue">4천만 원</span> 절감<br> 산출세액 4천만 원</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">지정기부금 단체</td>
                                            <td class="donation-benefits">1천만 원 절감<br> 산출세액 7천만 원</td>
                                        </tr>
                                        <tr>
                                            <td class="donation-level">비인허가 단체</td>
                                            <td class="donation-benefits">절감 없음<br> 산출세액 8천만 원</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="donation-level info-text">법인 기부자께서 동아대학교에 기부하시면 당해 사업연도 연간 소득금액(이월결손금 차 감 후)의 50% 범위 내에서 손비처리가 가능 합니다.<br><br>
                                                동아대학교는 법정기부금 단체이므로 같은 금액을 기부하셔도 연간 소득금액의 10% 범 위내에 손비처리가 가능한 민간 지정기부금 단체 대비 더 많은 세제헤택을 받으 실 수 있습니다.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="fame-info-wrap">
                                <p><i class="fa fa-clipboard-check"></i>위의 예시는 기부자 분들의 이해를 돕기 위한 이상적인 수치를 대입한 결과이며 실제 세액산출 내용과 다를 수 있습니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include("_include.donate")
    </div>
@endsection
