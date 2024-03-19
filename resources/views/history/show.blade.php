@extends("layouts/layout")

@section("title")
    기부내역 조회 - 상세내역
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div id="history-container" class="container">

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                  //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents__sub-header sub-introduce">
                    <div class="sh-con sh-con__left">
                        <div class="img-wrap">
                            <img src="/img/sub_introduce_img.png" alt="서브페이지 소개 사진">
                        </div>
                    </div>
                    <div class="sh-con sh-con__right">
                        <div class="text-wrap">
                            <div class="sub-header__title"><span>“홍길동 님,</span> 동아대학교에 기부해 주셔서 감사드립니다.”</div>
                            <div class="sub-header__content">
                                동아대학교는 1946년 개교 이래 많은 기부자분들의 지원으로 성장해 왔습니다.<br/>
                                보내주신 소중한 기부금은 기부자분께서 뜻하신 바와 같이학내 지원이 필요한 적재적소에 배분하여 동아의 새로운 도약을 이루겠습니다.<br/>
                                고맙습니다.
                            </div>
                            <div class="sub-header__signature">
                                <span>동아대학교 총장</span>
                                <img src="/img/signature_img.jpg" alt="서명">
                            </div>
                        </div>
                    </div>
                </div>{{-- .contents-sub-header.sub-instroduce end --}}

                <div class="contents-body">

                    <div class="hist-show__table">
                        <table class="visible__pc">
                            <thead>
                            <tr>
                                <th class="hist-thd-01">약정일자</th>
                                <th class="hist-thd-02">증서번호</th>
                                <th class="hist-thd-03">기부유형</th>
                                <th class="hist-thd-04">기부금 용도</th>
                                <th class="hist-thd-05">납입방법</th>
                                <th class="hist-thd-06">납입일자</th>
                                <th class="hist-thd-07">납입금액</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach(range(1,12) as $list)
                                <tr>
                                    <td class="hist-thd-01">2020.03.04.</td>
                                    <td class="hist-thd-02">20180124</td>
                                    <td class="hist-thd-03">정기기부</td>
                                    <td class="hist-thd-04">경영대학 DAUist 발전기금</td>
                                    <td class="hist-thd-05">자동이체</td>
                                    <td class="hist-thd-06">2021.09.02.</td>
                                    <td class="hist-thd-07">10,000원</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>{{-- .visible__pc end --}}

                        <div class="visible__re">
                            <h1>기부내역</h1>

                            @foreach(range(1, 10) as $list)
                            <ul>
                                <li>
                                    <span>납입일자</span><p>2020-10-10</p>
                                </li>
                                <li>
                                    <span>기탁금용도</span><p>주요 캠페인 지원</p>
                                </li>
                                <li>
                                    <span>프로그램명</span><p>동아 100년 동행</p>
                                </li>
                                <li>
                                    <span>총 납입금액</span><p>300,000원</p>
                                </li>
                                <li>
                                    <span>납입금액</span><p>30,000원</p>
                                </li>
                                <li>
                                    <span>납입구문</span><p>정기</p>
                                </li>
                                <li>
                                    <span>납입방법</span><p>자동이체</p>
                                </li>
                                <li>
                                    <span>납입횟수</span><p>10</p>
                                </li>
                                <li>
                                    <span>약정시작일</span><p>2020-10-10</p>
                                </li>
                                <li>
                                    <span>약정종료일</span><p></p>
                                </li>
                            </ul>
                            @endforeach

                        </div>{{-- .visible__re end --}}

                        <div class="pg-wrap">
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
                    </div>{{-- .hist-show-table end --}}

                    <div class="btn-box">
                        <a href="" class="btn-back"><i class="fas fa-undo"></i>돌아가기</a>
                    </div>

                </div>{{-- .contents-body end --}}

            </div>{{-- .page-contents end --}}
        </div>{{-- .sub-page-wrap end --}}

        <div class="visible__re-article">
            <div class="re-article__cate">인터뷰</div>
            <h1 class="re-article__subject">구문갑 청호냉동(주) 회장, ‘동아
                100년 동행’ 발전기금 2억 5,0...</h1>
            <img class="re-article__img" src="/img/history_show_article_img.png" alt="히스토리 하단 뉴스 이미지">
        </div>

        <div class="page-footer">
            @include ("_include.donate")
        </div>
    </div>{{-- .container end --}}

@endsection