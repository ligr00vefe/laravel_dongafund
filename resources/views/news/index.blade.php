@extends("layouts/layout")

@section("title")
    기부소식 - 목록
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div id="news-container" class="container" >

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                 //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

            <div class="contents-header">
                <ul class="dis-ib ff-paybookbold">
                    <li class="{{ $category === "" ? "focused" : "" }} t1">
                        <a href="/news">
                            <i class="fas fa-layer-group"></i>
                            전체보기
                        </a>
                    </li>
                    <li class="{{ focused($category, "기부소식") }} t2">
                        <a href="/news?category=기부소식">
                            기부소식
                        </a>
                    </li>
                    <li class="{{ focused($category, "동아뉴스") }} t4">
                        <a href="/news?category=동아뉴스">
                            동아뉴스
                        </a>
                    </li>
                    <li class="{{ focused($category, "동아는 지금") }} t3">
                        <a href="/news?category=동아는 지금">
                            동아는 지금
                        </a>
                    </li>
                    <li class="{{ focused($category, "기부스토리") }} t5">
                        <a href="/news?category=기부스토리">
                            기부스토리
                        </a>
                    </li>
                </ul>
            </div>{{-- .contents-header end --}}

            <div class="contents-body">
                    @if (count($lists) > 0)
                        @include ("news.include.list")
                    @endif
            </div>

        </div>{{-- .page-contents end --}}

    </div>{{-- .sub-page-wrap end --}}

    <div class="page-footer">
        @include ("_include.donate")
    </div>

    </div>{{-- .container end --}}

@endsection
