@extends("layouts.layout")

@section("title")
    기부하기
@endsection

@push("scripts")
    <link rel="stylesheet" href="/lib/splide-2.4.21/dist/css/splide.min.css">
    <script src="/lib/splide-2.4.21/dist/js/splide.min.js"></script>
@endpush

@section("content")

    <section class="fund-intro">
        <div class="container small">

            <div class="over-hidden">
                <article class="fund-intro__cell">
                    <div class="fund-intro__cell-head">
                        <div class="fund-intro__cell-head__subject">
                            <h3>대학 발전 전반에 기부</h3>
                            <i class="fa fa-gift"></i>
                        </div>
                    </div>

                    <div class="fund-intro__cell-body">
                        <p>
                            대학에서 판단하여 가장 지원이 필요한 적재적소에 지원 할 수 있습니다.
                        </p>
                        <p>
                            기부자님의 소중한 기부금은 법인세법 제24조에 따라 교육비, 연구비, 장학금, 시설비 항목으로 엄 격히 한정하여 사용됩니다.
                        </p>
                        <div class="t-center">
                            <a href="/donate?program=7">
                                기부하기
                            </a>
                        </div>
                    </div>
                </article>

                <article class="fund-intro__cell--small">
                    <ul class="fund-intro__cell-row">
                        <li class="fund-intro__cell-column color-deep">
                            <a href="/support?type=campaign">
                                <i class="fa fa-book-open"></i>
                                <p>
                                    기부 프로그램 살펴보기
                                </p>
                            </a>
                        </li>
                        <li class="fund-intro__cell-column color-sky">
                            <a href="/benefit">
                                <i class="fa fa-file-invoice-dollar"></i>
                                <p>
                                    세제혜택 알아보기
                                </p>
                            </a>
                        </li>
                    </ul>
                </article>
            </div>

            <article class="fund-intro__cell-footer">

                <table>
                    <tr>
                        <th>
                            <i class="fa fa-exclamation-circle"></i>
                        </th>
                        <td>
                            <p>
                                학생이나 교직원 이신가요?
                                <a href="#">
                                    로그인
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fa fa-question-circle"></i>
                        </th>
                        <td>
                            <p>
                                복잡하신가요? 전화/우편/팩스로 바로 기부하실수 있습니다!
                                <a href="#">
                                    바로가기
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>


            </article>
        </div>
    </section>

@endsection
