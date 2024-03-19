@extends("layouts/layout")

@section("title")
    기부하기
@endsection

@push("scripts")
    <link rel="stylesheet" href="/lib/splide-2.4.21/dist/css/splide.min.css">
    <script src="/lib/splide-2.4.21/dist/js/splide.min.js"></script>
@endpush

@section("content")

    <div class="m-top-150"></div>

    <div class="container long">

        <div class="fund-wrap swp-row-100-white p-top-100 ff-paybookbold">

            <div class="swp-center-layout">

                <div class="swp-col-100">
                    <a href="#" class="btn-fund-action">
                        학교발전 전반에 기부
                    </a>
                </div>
                <div class="swp-col-100">
                    <a href="#" class="btn-view-action">
                        지원이 필요한 곳 살펴보기
                    </a>
                </div>

            </div>

            <div class="question-wrap m-top-40 ff-paybookmedium">

                <div class="swp-col-100">

                    <p class="before-mark-orange-bang">
                        이전에 동아대학교에 기부하신 적이 있으신가요?
                    </p>

                </div>

                <div class="swp-col-100 m-top-10">

                    <p class="before-mark-orange-bang">
                        동아대학교 교직원이나 재학생이신가요?
                    </p>

                </div>

            </div>


            <div class="slider-wrap p-top-60 b-top-gray">

                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="img-wrap" style="background-image:url(/img/main_content4_image1.png)">
                                </div>
                                <div class="text-wrap">
                                    <strong>스포츠단 후원회</strong>
                                    <p>
                                        동아대학교 내부 스포츠단의 발전 및 인재양성을 위해 다양한 혜택 및 후원을 지원
                                    </p>
                                </div>
                            </li>


                        </ul>
                    </div>

                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <img src="/img/arrow_prev.png" alt="이전버튼">
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <img src="/img/arrow_next.png" alt="다음버튼">
                        </button>
                    </div>
                </div>

            </div>

        </div>

        <div class="simple-fund-wrap m-top-40">
            <div class="selector-in">
                <form action="">
                    <input type="hidden">
                    <ul class="dis-ib">
                        <li><button type="button" class="on">1만원</button></li>
                        <li><button type="button">5만원</button></li>
                        <li><button type="button">10만원</button></li>
                        <li><input type="text" placeholder="직접입력"></li>
                    </ul>
                    <button class="btn-submit-orange">기부하기</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide( '.splide', {
                perPage: 4,
                perMove: 1,
                rewind: true,
                // autoWidth: true,
                gap: 25,
                classes: {
                    arrows: 'splide__arrows',
                    prev  : 'splide__arrow--prev splide__arrow--prev',
                    next  : 'splide__arrow--next splide__arrow--next',
                },
            } ).mount();

        });
    </script>


@endsection
