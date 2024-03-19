@extends("layouts/layout")

@section("title")
    후원의 집 - 글보기
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/sponsor.css">
@endpush

@section("content")
    <div id="cz">
        <div id="all-wrap">
        <section id="section-sponsor-show">
            <div class="sponsor-sector-first">
                <ul id="ul-sponsor-head-menu">
                    <li>동아대학교</li>
                    <li>동아대학교 발전기금</li>
                </ul>
            </div>
            <div id="sponsor-show-all">
                <div class="show-img-box">
                    <img class="show-img" src="/img/sponsors_show.png" alt="이미지">
                </div>
                <div class="show-content-all">
                    <div class="show-text-box">
                        <h2>얼룩돼지식당</h2>
                        <p>대한민국 상위 0.3% 얼룩돼지전문점으로 맛과 트렌디한 감성으로 준비되었습니다</p>
                        <p><span class="text-pointer">영업시간:</span> 10:00 ~ 20:00</p>
                        <p><span class="text-pointer">주소:</span> 경상남도 김해시 율하동 1326-1 1층</p>
                    </div>
                    <div class="show-button-wrap">
                        <div class="sponsor-map-box">
                            <a href="#">
                                <div class="sponsor-map-button">지도보기</div>
                            </a>
                        </div>
                        <div class="sponsor-list-box">
                            <a href="/sponsors">
                                <div class="sponsor-list-button">목록</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <p>COPYRIGHT 2021 DONG-A UNIVERSITY ALL RIGHTS RESERVED.</p>
            </div>
        </section>
        </div>
    </div>
@endsection
