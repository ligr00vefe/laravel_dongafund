@extends("layouts/layout")

@section("title")
    기부금 영수증 발급
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/fund.css">
@endpush

@section("content")
    <div class="m-top-100"></div>

    <div class="container">
        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                  //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents-header">
                    <ul class="dis-ib ff-paybookbold">
                        <li class="{{ focused($type, "2021") }} t1">
                            <a href="/receipt?type=2021">
                                2021년
                            </a>
                        </li>
                        <li class="{{ focused($type, "2020") }} t2">
                            <a href="/receipt?type=2020">
                                2020년
                            </a>
                        </li>
                        <li class="{{ focused($type, "2019") }} t4">
                            <a href="/receipt?type=2019">
                                2019년
                            </a>
                        </li>
                        <li class="{{ focused($type, "2018") }} t3">
                            <a href="/receipt?type=2018">
                                2018년
                            </a>
                        </li>
                        <li class="{{ focused($type, "2017") }} t5">
                            <a href="/receipt?type=2017">
                                2017년
                            </a>
                        </li>
                    </ul>
                </div>{{-- .contents-header end --}}

            <!-- 총장말씀 -->
                <div class="contents__sub-header sub-introduce">
                    <div class="sh-con">
                        <div class="sh-con__left">
                            <div class="img-wrap">
                                <img src="/img/sub_introduce_img.png" alt="서브페이지 소개 사진">
                            </div>
                        </div>
                        <div class="sh-con sh-con__right">
                            <div class="text-wrap">
                                <div class="sub-header__title">“홍길동 님, 동아대학교에 기부해 주셔서 감사드립니다.”</div>
                                <div class="sub-header__content">동아대학교는 1946년 개교 이래 많은 기부자분들의 지원으로 성장해 왔습니다.<br/> 보내주신 소중한
                                    기부금은 기부자분께서 뜻하신 바와 같이학내 지원이 필요한 적재적소에 배분하여 동아의 새로운 도약을 이루겠습니다. <br/>고맙습니다.
                                </div>
                                <div class="sub-header__signature">
                                    <span>동아대학교 총장</span>
                                    <img src="/img/signature_img.jpg" alt="서명">
                                </div>
                            </div>
                        </div>
                    </div>{{-- .sh-con end --}}
                </div>{{-- .contents-sub-header.sub-instroduce end --}}

            <!-- 영수증 start -->
                <div class="container__inner swp-row-100-white ff-paybookbold container__inner">
                    <div class="container__inner-guidance test">
                        <div class="test">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="test">
                            <p>개인 기부자께서는 별도로 기부금 영수증을 발급받지 않으셔도 됩니다.</p>
                            <p class="test">동아대학교는 매년 연말 홍길동 님의 기부내역이 연말정산간소화 서비스에 등재되도록 국세청에 기부내역을 일괄 전송하고 있습니다.</p>
                            <p class="test"><span>대외협력처(051-200-6012)</span>로 전화주시면 상세히 안내해 드리겠습니다.</p>
                        </div>


                    </div>

                    <!-- 발행 완료 건 start -->
                    <div class="container__inner-publish test">
                        <div class="publish">
                            <span>발급완료 건</span>
                        </div>

                        <table>
                            <caption>국세청 발행완료 테이블</caption>
                            <thead>
                            <tr>
                                <th class="test">선택</th>
                                <th class="test">영수증번호</th>
                                <th class="test">발급일자</th>
                                <th class="test">구분</th>
                                <th class="test">기부연월</th>
                                <th class="test">내용</th>
                                <th class="test">금액</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach (range(1,3) as $list)
                                <tr>
                                    <td class="test">
                                        <input type="checkbox" id="checkbox0<?php echo $list ?>">
                                        <label for="checkbox0<?php echo $list ?>"></label>
                                    </td>
                                    <td class="test">국세청 전송</td>
                                    <td class="test">2021.04.25</td>
                                    <td class="test">금전</td>
                                    <td class="test">2021.02.20</td>
                                    <td class="test">대학 발전기금</td>
                                    <td class="test">10,000원</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="issued-box">
                            <ul class="issued-box__list">
                                <li>
                                    <button type="button" class="issued-box__button basic">
                                        기부금 영수증 다운로드
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 영수증 발행 완료건 end -->

                    <!-- 영수증 미발급 건 start -->
                    <div class="container__inner-not-issued test">
                        <div class="publish">
                            <span>미발급 건</span>
                        </div>

                        <table>
                            <caption>국세청 발행완료 테이블</caption>
                            <thead>
                            <tr>
                                <th class="test">선택</th>
                                <th class="test">영수증번호</th>
                                <th class="test">발급일자</th>
                                <th class="test">구분</th>
                                <th class="test">기부연월</th>
                                <th class="test">내용</th>
                                <th class="test">금액</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach (range(1,3) as $list)
                                <tr>
                                    <td class="test">
                                        <input type="checkbox" id="checkbox0<?php echo ($list + 3) ?>">
                                        <label for="checkbox0<?php echo ($list + 3) ?>"><span></span></label>
                                    </td>
                                    <td class="test">국세청 전송</td>
                                    <td class="test">2021.04.25</td>
                                    <td class="test">금전</td>
                                    <td class="test">2021.02.20</td>
                                    <td class="test">대학 발전기금</td>
                                    <td class="test">10,000원</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="issued-box">
                            <ul class="issued-box__list">
                                <li>
                                    <button type="button" class="issued-box__button basic">
                                        기부금 영수증 다운로드
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 영수증 미발급 건 end -->

                    <!-- 영수증 발급 건 start -->
                    <div class="container__inner-issued test">
                        <div class="publish">
                            <span>2020년 발행완료 건</span>
                        </div>

                        <table>
                            <caption>국세청 발행완료 테이블</caption>
                            <thead>
                            <tr>
                                <th class="test">선택</th>
                                <th class="test">영수증번호</th>
                                <th class="test">발급일자</th>
                                <th class="test">구분</th>
                                <th class="test">기부연월</th>
                                <th class="test">내용</th>
                                <th class="test">금액</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach (range(1,3) as $list)
                                <tr>
                                    <td class="test">
                                        <input type="checkbox" id="checkbox0<?php echo ($list + 6) ?>">
                                        <label for="checkbox0<?php echo ($list + 6) ?>"></label>
                                    </td>
                                    <td class="test">국세청 전송</td>
                                    <td class="test">2021.04.25</td>
                                    <td class="test">금전</td>
                                    <td class="test">2021.02.20</td>
                                    <td class="test">대학 발전기금</td>
                                    <td class="test">10,000원</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="pg-wrap" style="text-align: center">
                            <div class="pg-prev"><i class="fas fa-chevron-left"></i></div>
                            <ul>
                                <li class="pg-num pg-current"><a href="">1</a></li>
                                <li class="pg-num"><a href="">2</a></li>
                                <li class="pg-num"><a href="">3</a></li>
                                <li class="pg-num"><a href="">4</a></li>
                                <li class="pg-num"><a href="">5</a></li>
                            </ul>
                            <div class="pg-next"><i class="fas fa-chevron-right"></i></div>
                        </div>

                        <div class="issued-box">
                            <ul class="issued-box__list">
                                <li>
                                    <button type="button" class="issued-box__button basic">
                                        선택발급
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 영수증 미발급 건 end -->
                    <div class="container__inner-more">
                        <button type="button" class="inner-more__button">
                            기부내역바로가기
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-footer">
            @include ("_include.donate")
        </div>

    </div>

@endsection
