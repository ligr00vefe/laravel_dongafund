@extends("layouts/layout")

@section("title")
    기부하기
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/fund.css">
@endpush

@section("content")

    <div class="m-top-100"></div>

    <div class="container">
        <div class="support-wrap">
            <div class="page-header dis-flex-bet">
                <div>
                    <h1>기부자 라운지</h1>
                    <span>지역을 품고 세계와 함께하는 명문 사학<span class="visible__fhd">, 동아대학교</span></span>
                </div>
            </div>
        </div>

        <div class="fund-wrap swp-row-100-white p-top-100 ff-paybookbold">
            <ul class="fund-box fund-flex">
                <li>
                    <img src="/img/etc_icon_01.png" alt="">
                    <div class="text-wrap">
                        <p>부산은행 모바일뱅킹</p>
                        <div>
                            부산은행 모바일뱅킹 APP을 통해 기부에<br>
                            <span>참여할 수 있습니다.</span>
                        </div>
                    </div>
                    <a class="" href="button">APP바로가기</a>
                </li>
                <li>
                    <img src="/img/etc_icon_02.png" alt="">
                    <div class="text-wrap">
                        <p>현물</p>
                        <div>
                            현물 기부는 대외협력처를 통해서<br>
                            <span>기부에 참여하실 수 있습니다.</span>
                        </div>
                    </div>
                    <a class="" href="tel">051-200-5012</a>
                </li>
                <li>
                    <img src="/img/etc_icon_03.png" alt="">
                    <div class="text-wrap">
                        <p>증권</p>
                        <div>
                            증권 기부는 대외협력처를 통해서<br>
                            <span>기부에 참여하실 수 있습니다.</span>
                        </div>
                    </div>
                    <a class="" href="button">APP바로가기</a>
                </li>
            </ul>

            <ul id="mainNoticeNavigation" class="dot-nav sw-md-block sw-ta-center">
                <li class="dot-blue on"></li>
                <li class="dot-blue"></li>
                <li class="dot-blue small"></li>
                <li class="dot-blue small"></li>
            </ul>


        </div>

        <div class="page-footer">
            @include ("_include.donate")
        </div>

    </div>




@endsection
