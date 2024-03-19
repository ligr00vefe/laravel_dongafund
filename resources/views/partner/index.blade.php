@extends("layouts/partners")

@section("title")
    협정체결 기관
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/lounge.css">
    <link rel="stylesheet" href="/css/news.css">
    <link rel="stylesheet" href="/css/fund.css">
@endpush

@section("content")
    <div class="partner-container container">
        <div class="sub-page-wrap">
            <div class="partner--header">
                <div class="partner--header-menu">
                    <ul>
                        <li>
                            <a href="">
                                동아대학교
                            </a>
                        </li>
                        <li>
                            <a href="">
                                동아대학교 발전기금
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h1>협정기관 체결</h1>
                </div>
                <div class="page-header">
                    <div class="page-header__search">
                        <form action="">
                            <input type="text" name="term" class="input-search" placeholder="검색어를 입력해주세요">
                            <button class="btn-search">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>{{-- .page-header end --}}
            </div>

            <div class="container__inner--partner swp-row-100-white ff-paybookbold">

                <div>
                    <ul class="partner-content">
                        @if (count($lists) > 0)
                            @foreach ($lists as $list)
                                <li>
                                    {{--<a href="/sponsors/show">--}}
                                        <div class="sponsor-list-img">
                                            <img class="sponsor-img" src="storage/{{getAttachPath($list->thumbnail)}}" alt="리스트 이미지">
                                        </div>
                                        <div class="content-title">
                                            <p>{{$list->space2}}</p>
                                            <p>체결일자 : {{substr($list->from_date, 0, 10)}}</p>
                                        </div>
                                    {{--</a>--}}
                                </li>
                            @endforeach
                        @else
                            <li>
                                <div class="empty_div" style="width:100%;">
                                    게시물이 없습니다.
                                </div>
                            </li>
                        @endif

                    </ul>
                </div>

                {{--<div class="sponsor-action-menu">--}}
                    {{--<div class="delete-button">선택삭제</div>--}}
                    {{--<div class="write-button">글쓰기</div>--}}
                {{--</div>--}}

                {{--페이징--}}
                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}
            </div>

            <div class="copyright-wrap">
                <p>COPYRIGHT 2021 DONG-A UNIVERSITY ALL RIGHTS RESERVED.</p>
            </div>

        </div>
    </div>

@endsection
