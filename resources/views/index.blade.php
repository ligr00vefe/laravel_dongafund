@extends("layouts/layout")

@section("title")
    메인
@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css">
    <link rel="stylesheet" href="/lib/slick/slick-theme.min.css">
@endpush

@section("content")

    <style>
        main {
            overflow: hidden;
        }
    </style>

    <section class="main-top">
        <div class="main-head__text">
{{--            <img src="/img/main_text.png" alt="메인텍스트" class="slide-text-large">--}}
{{--            <img src="/img/main_text_small.png" alt="메인텍스트" class="slide-text-small">--}}
            <h3>
                당신의 역사, 동아대학교
            </h3>
            <p>
                지역을 품고 세계와 함께하는 명문사학
            </p>
        </div>
        <div class="top-slick">
            <div class="slick-background">
                <div class="slick1"></div>
            </div>
            <div class="slick-background ">
                <div class="slick2"></div>
            </div>
            <div class="slick-background">
                <div class="slick3"></div>
            </div>
{{--            <div class="slick-background">--}}
{{--                <div class="slick4"></div>--}}
{{--            </div>--}}
        </div>

        <div class="main-donate-wrap">
            @include("_include.donate")
        </div>

    </section> <!-- main-top end -->


    <section class="main-content">

        <div class="main-container">

            <div class="content__body">

                <div id="mainNews" class="body-news" data-link="/news/{{ $notice->id }}">

                    <ul>
                        <li class="img-wrap">
                            <div style="background-image: url('storage/{{ getAttachPath($notice->thumbnail ?? "") }}')">
                            </div>
                        </li>
                        <li class="text-wrap">
                            <div class="main-body-news__title">
                                <p>
                                    #기부소식
                                </p>
                            </div>

                            <div class="main-body-news__subject">
                                <p>
                                    {{ $notice->title ?? "" }}
                                </p>
                            </div>

                            <div class="main-body-news__content">
                                <p class="sub-title">
                                    {{ $notice->subtitle ?? "" }}
                                </p>
                                <p class="content">
                                    {{ isset($notice->contents) ? strip_tags_blink_removing($notice->contents) : "" }}
                                </p>
                            </div>

                            <div class="main-body-news__bottom">
                                <a href="#">
                                    기사보기
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>

                        </li>
                    </ul>

                </div>

                <div class="body__donation">

                    <ul>
                        <li class="body__donation-text">
                            <p>
                                2020년 보내주신 동아사랑
                            </p>
                        </li>

                        <li>
                            <p class="body__donation-subject">
                                총 모금액
                            </p>
                            <p class="body__donation-contents">
                                55.8억원
                            </p>
                        </li>

                        <li>
                            <p class="body__donation-subject">
                                납입자수
                            </p>
                            <p class="body__donation-contents">
                                2,793명
                            </p>
                        </li>
                    </ul>

                </div>


                <div class="body__posts">

                    <ul>
                        @forelse ($programs as $program)
                            <li class="">
                                <div class="mouseover-event fadeout-010 hidden">
                                    <div class="post-info">
                                        @if ($program->icon)
                                            <img src="{{ "storage/" . getAttachPath($program->icon) }}" alt="아이콘">
                                        @else
                                            <i class="fas fa-university"></i>
                                        @endif
                                        <h3>
                                            {{ $program->subject }}
                                        </h3>
                                        <p>
                                            차별화된 교육, 연구지원으로 급변하는 취업환경에 적극적으로 대처할 수 있는 전문 인력을 양성
                                        </p>
                                        <div class="layout-center">
                                            <a href="/donate?program={{ $program->id }}">
                                                기부하기
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-wrapper fadein-010">
                                    <div class="img-wrap">
                                        <div class="background-img" style="background-image: url(storage/{{ getAttachPath($program->thumbnail ?? "") }})">
                                        </div>
                                    </div>
                                    <div class="text-wrap">
                                        <h3 class="">
                                            {{ $program->subject }}
                                        </h3>
                                        <p>
                                            <i class="fas fa-donate"></i>
                                            <span>누적모금액 580,000,000원</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @empty

                        @endforelse

                    </ul>

                    <div class="body__posts__nav-dot">

                        <a href="#" class="body__posts__nav-dot__target body__posts__nav-dot__target--focused" data-index="0"></a>
                        <a href="#" class="body__posts__nav-dot__target" data-index="1"></a>
                        <a href="#" class="body__posts__nav-dot__target" data-index="2"></a>

                    </div>


                </div>


                <div class="body__notice">

                    <ul class="video-wrap-ul">
                        <li class="notice-video">

                            <div class="thumbnail-wrap">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/YVSZBaRq7_Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-text">

                                <p>
                                    <i class="fab fa-youtube"></i>
                                    승학캠퍼스 봄 스케치
                                </p>
                                <a href="https://www.youtube.com/channel/UCYXWpF0ptQvQYSZlo41CPmg" target="_blank">
                                    바로가기
                                    <i class="fa fa-chevron-right"></i>
                                </a>

                            </div>

                        </li>

                        @foreach ($tidings as $tiding)
                        <li class="donga-news" data-link="/news/{{ $tiding->id }}">

                            <div class="thumbnail-wrap" style="background-image: url(storage/{{ getAttachPath($tiding->thumbnail) }})">

                            </div>
                            <div class="text-wrap">

                                <a href="/news?category=동아뉴스" class="hashtag">
                                    #동아뉴스
                                </a>

                                <p class="title">
                                    {{ $tiding->title }}
                                </p>

                                <p class="contents">
                                    {{ strip_tags_blink_removing($tiding->contents ?? "") }}
                                </p>

                            </div>

                        </li>
                        @endforeach

                    </ul>

                    <ul>

                    </ul>

                </div>

            </div>

        </div>

        @include("_include.donate")

    </section>

    <script>

        $(document).ready(function () {

            $('.top-slick').slick({
                dots: true,
                infinite: true,
                speed: 1000,
                fade: true,
                cssEase: 'linear',
                autoplay:true,
                arrows: false,
            });

        });

        const posts = document.querySelectorAll(".main-content .body__posts ul li");

        Array.prototype.forEach.call(posts, function (i, v) {

            i.addEventListener("mouseover", function () {
                i.classList.add('on');
                fadeIn(i.querySelector(".mouseover-event"));
                fadeOut(i.querySelector(".content-wrapper"));
            });

            i.addEventListener("mouseleave", function () {
                i.classList.remove('on');
                fadeIn(i.querySelector(".content-wrapper"));
                fadeOut(i.querySelector(".mouseover-event"));
            });

        });

        const mobilePotsDotWrapper = document.querySelector(".main-content .body__posts ul");
        const mobilePostsDotNavigation = document.querySelectorAll("a.body__posts__nav-dot__target");
        const windowWidth = window.innerWidth;


        if (windowWidth < 769)
        {
            mobilePostsDotNavigation.forEach(function (i) {

                const _order = i.dataset.index;
                const _right = _order * 284;

                i.onclick = function (e) {
                    e.preventDefault();
                    const _focused = document.querySelector(".body__posts__nav-dot__target--focused");
                    _focused.classList.remove("body__posts__nav-dot__target--focused")
                    mobilePotsDotWrapper.style.right = _right + 'px';
                    i.classList.add("body__posts__nav-dot__target--focused")
                }

            });
        }


        const mainNews = document.getElementById("mainNews");
        mainNews.addEventListener("click", function () {
            location.href = this.dataset.link;
        })

        const dongaNewsLink = document.querySelectorAll(".donga-news")
        dongaNewsLink.forEach(function (i,v) {
            i.addEventListener("click", function () {
                location.href = i.dataset.link;
            })
        });


        const screenWidth = screen.availWidth;

        if (screenWidth < 768) {
            const IMAGE_WIDTH = 375;
            const mobile_swipe = document.querySelector(".main-content .body__posts ul");
            const dotTarget = document.querySelectorAll(".body__posts__nav-dot__target");
            let curPos = 0;
            let postion = 0;
            let start_x, end_x;

            mobile_swipe.addEventListener("touchstart", touch_start);
            mobile_swipe.addEventListener("touchend", touch_end);

            function prev(){
                if(curPos > 0){
                    dotTarget.forEach(function (i,v) {
                        i.classList.remove("body__posts__nav-dot__target--focused");
                    })
                    postion += IMAGE_WIDTH;
                    mobile_swipe.style.transform = `translateX(${postion}px)`;
                    curPos = curPos - 1;
                    document.querySelector(".body__posts__nav-dot__target[data-index='"+ curPos +"']").classList.add("body__posts__nav-dot__target--focused")
                }
            }
            function next(){
                if(curPos < 2){
                    dotTarget.forEach(function (i,v) {
                        i.classList.remove("body__posts__nav-dot__target--focused");
                    })
                    postion -= IMAGE_WIDTH;
                    mobile_swipe.style.transform = `translateX(${postion}px)`;
                    curPos = curPos + 1;
                    document.querySelector(".body__posts__nav-dot__target[data-index='"+ curPos +"']").classList.add("body__posts__nav-dot__target--focused")
                }
            }

            function touch_start(event) {
                start_x = event.touches[0].pageX
            }

            function touch_end(event) {
                end_x = event.changedTouches[0].pageX;
                if(start_x > end_x){
                    next();
                }else{
                    prev();
                }
            }
        }


    </script>

@endsection
