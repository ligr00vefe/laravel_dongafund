@extends("layouts/layout")

@section("title")
    기부소식 - 글보기
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div id="news-container" class="container">

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                 //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents-header">
                    <ul class="dis-ib ff-paybookbold">
                        <li class="{{ focused($post->category, "전체보기") }} t1">
                            <a href="/news">
                                <i class="fas fa-layer-group"></i>
                                전체보기
                            </a>
                        </li>
                        <li class="{{ focused($post->category, "기부소식") }} t2">
                            <a href="/news?category=기부소식">
                                기부소식
                            </a>
                        </li>
                        <li class="{{ focused($post->category, "동아뉴스") }} t4">
                            <a href="/news?category=동아뉴스">
                                동아뉴스
                            </a>
                        </li>
                        <li class="{{ focused($post->category, "동아는 지금") }} t3">
                            <a href="/news?category=동아는 지금">
                                동아는 지금
                            </a>
                        </li>
                        <li class="{{ focused($post->category, "기부스토리") }} t5">
                            <a href="/news?category=기부스토리">
                                기부스토리
                            </a>
                        </li>
                    </ul>
                </div>{{-- .contents-header end --}}

                <div class="contents-body">

                    {{--글보기 페이지 본문 시작--}}
                    <div id="news-show__container">
                        <div class="news-show__header">
                            <span class="news-show__cate">#{{ $post->category }}</span>
                            <h1 class="news-show__subject">{{ $post->title }}</h1>
                            <ul class="news-show__header-shortcut">
                                <li><span>취재</span><p>{{ $post->space1 }}</p></li>
                                <li><span>사진</span><p>{{ $post->space2 }}</p></li>
                                <li class="shortcut__datetime"><span>입력</span><p>{{ date("Y-m-d", strtotime($post->from_date)) . " (". getWeekDay($post->from_date) . ")" }}</p></li>
                            </ul>
                        </div>
                        {{-- 글보기 레이아웃 시작 --}}
                        <div class="news-show__body">
                            <div class="news-show__contents">
                                <img src="/storage/{{ getAttachPath($post->thumbnail ?? null) }}" alt="썸네일">
                                <span class="subtitle">{{ $post->subtitle }}</span>
                                <div>
                                    {!! $post->contents !!}
                                </div>
                            </div>

                            <div class="btn-box">
                                <a href="/news" class="btn-list"><i class="fas fa-th-list"></i>목록</a>
                            </div>

                        </div>{{-- .board-show-body end --}}
                        {{-- 글보기 본문 끝 --}}

                        {{-- 본문 옆 사이드 기사 --}}
                        <div class="news-show__aside">
                            <span><i class="fas fa-book-open"></i>기부 프로그램</span>
                            <ul class="news-show__aside-list">
                                @foreach ($programs as $program)
                                    <li>
                                        {{--앞면 시작--}}
                                        <div class="front-page">
                                            <div class="as-img__wrap {{ $_SERVER['SERVER_NAME'] }}">
                                                <img src="{{
                                                        $program->thumbnail
                                                        ? "https://{$_SERVER['SERVER_NAME']}/storage/" .getAttachPath($program->thumbnail)
                                                        : "/img/contract_top_noimg.jpg"
                                                    }}" alt="">
                                            </div>
                                            <div class="as-text__wrap">
                                                <span>{{ $program->subject }}</span>
                                                <p><i class="fas fa-donate"></i>누적모금액 580,000,000원</p>
                                            </div>
                                        </div>{{-- .front-page end --}}

                                        {{--뒷면 시작--}}
                                        <div class="hidden-page">
                                            <i class="fas fa-university"></i>
                                            <h3>{{ $program->subject }}</h3>
                                            {!! $program->contents !!}


                                            <a href="/donate?program={{ $program->id }}" class="donate-btn">기부하기</a>
                                        </div>{{-- .hidden-page end --}}
                                    </li>
                                @endforeach
                            </ul>{{-- .show-aside-list end --}}

                            <div class="aside-btn">
                                <a href="">더보기 <i class="fas fa-chevron-right"></i></a>
                            </div>

                        </div>{{-- .board-show-aside end --}}
                        {{-- 사이드 기사 끝 --}}

                    </div>{{-- #board-container end --}}

                </div>{{-- .contents-body end --}}

            </div>{{-- .page-contents end --}}

        </div>{{-- .sub-page-wrap end --}}

        <div class="page-footer">
            @include ("_include.donate")
        </div>

    </div>{{-- .container end --}}

@endsection
