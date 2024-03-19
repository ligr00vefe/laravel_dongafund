@extends("layouts/layout")

@section("title")
    후원의 집
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/sponsor.css">
@endpush

@section("content")
    <div id="cz">
        <div id="index-all-wrap">
        <section id="section-sponsor">
            <div class="sponsor-sector-first">
                <ul id="ul-sponsor-head-menu">
                    <li>동아대학교</li>
                    <li>동아대학교 발전기금</li>
                </ul>
            </div>
            <ul id="ul-sponsor-content">
                <li class="li-sponsor-first-content">
                    <div class="sponsor-list">
                        <div class="sponsor-title-wrap">
                            <p>동아대와</p>
                            <p>함께하는</p>
                            <p><span class="point-blue">후원의 집</span><img src="/img/sponsor_home_icon.png" alt="이미지"></p>
                        </div>
                        <div class="sponsor-search-wrap"><input class="sponsor-search-box" type="text"><img class="sponsor-search-icon" src="/img/sponsor_search_icon.png" alt="이미지"></div>
                        <div class="sponsor-symbol-wrap"><img src="/img/sponsor_mini_symbol.png" alt="이미지">동아대학교 발전기금</div>
                    </div>
                </li>
{{--                @for($i = 0; $i < 19; $i++)--}}
{{--                    <li>--}}
{{--                        <a href="/sponsors/show">--}}
{{--                            <div class="sponsor-list-img">--}}
{{--                                <img class="sponsor-img" src="/img/sponsor_list_sample_img.png" alt="리스트 이미지">--}}
{{--                            </div>--}}
{{--                            <div class="sponsor-more-button">--}}
{{--                                <p>더보기</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endfor--}}
            </ul>
            <div class="sponsor-action-menu">
                <div class="delete-button">선택삭제</div>
                <div class="write-button">글쓰기</div>
            </div>
            <div id="paging-wrap">
                <ul class="ul-paging">
                    <li class="on"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><a href="#">10</a></li>
                </ul>
            </div>
            <div class="copyright-wrap">
                <p>COPYRIGHT 2021 DONG-A UNIVERSITY ALL RIGHTS RESERVED.</p>
            </div>
        </section>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#cz #ul-sponsor-content li').on("mouseover", function(){
                $(".sponsor-list-img").css("filter", "brightness(100%)");
                $(this).find(".sponsor-list-img").css("filter", "brightness(50%)");
                $(this).find(".sponsor-more-button").css({"display":"inline-block"})
            })
            $('#cz #ul-sponsor-content li').on("mouseout", function(){
                $(".sponsor-list-img").css("filter", "brightness(100%)");
                $(".sponsor-more-button").css("display", "none");
            })
        })
    </script>
@endsection
