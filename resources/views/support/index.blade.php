@extends("layouts.layout")

@section("title")
    기부 프로그램 - {{ $title }}
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div class="container">

        <div class="support-wrap">

            <div class="page-header dis-flex-bet">
                <div>
                    <h1>기부 프로그램</h1>
                    <span>지역을 품고 세계와 함께하는 명문 사학, <span class="dis-none-small">동아대학교</span></span>
                </div>

                @include("_include.board.search")
            </div>



            <div class="page-contents swp-row-100-white">

                <div class="contents-header">
                    <ul class="dis-ib ff-paybookbold">
                        <li>
                            <a href="/donate">
                                <i class="fa fa-gift"></i>
                                대학발전 <span class="dis-block-middle"></span>전반 지원
                            </a>
                        </li>
                        <li class="{{ focused($category, "campaign") }} t1">
                            <a href="/support?category=campaign">
                                <i class="fa fa-users"></i>
                                주요 캠페인 <span class="dis-block-middle"></span>지원
                            </a>
                        </li>
                        <li class="{{ focused($category, "student") }} t2">
                            <a href="/support?category=student">
                                <i class="fa fa-graduation-cap"></i>
                                학생 지원
                            </a>
                        </li>
                        <li class="{{ focused($category, "research") }} t3">
                            <a href="/support?category=research">
                                <i class="fa fa-flask"></i>
                                연구 지원
                            </a>
                        </li>
                        <li class="{{ focused($category, "college") }} t4">
                            <a href="/support?category=college">
                                <i class="fa fa-university"></i>
                                단과대/학과 <span class="dis-block-middle"></span>지원
                            </a>
                        </li>
                        <li class="{{ focused($category, "life") }} t5">
                            <a href="/support?category=life">
                                <i class="fa fa-chalkboard-teacher"></i>
                                대학생활 <span class="dis-block-middle"></span>지원
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="contents-body">
                    @includeWhen ($head, "support.include.head")
                    @include ("support.include.list")
                </div>

            </div>

            <div class="support-footer">
                @include ("_include.donate")
            </div>

        </div>

    </div>



@endsection
