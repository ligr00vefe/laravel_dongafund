@extends("layouts/admin")

@section("title")
    개인정보 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 개인정보 동의 내역
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="/css/pickday_white.css">
@endpush

@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?? "focused" }} t1">
                <a href="/b1BjW55p/privacy/agreement">
                    전체보기
                </a>
            </li>
            <li class="{{ focused($category, "약정서") }} t2">
                <a href="/b1BjW55p/privacy/agreement?category=약정서">
                   약정서
                </a>
            </li>
            <li class="{{ focused($category, "전자서명") }} t3">
                <a href="/b1BjW55p/privacy/agreement?category=전자서명">
                    전자서명
                </a>
            </li>
            <li class="{{ focused($category, "본인인증") }} t4">
                <a href="/b1BjW55p/privacy/agreement?category=본인인증">
                    본인인증
                </a>
            </li>
        </ul>
    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left">
                <div class="search-date">
                    <form action="">
                        <input type="text" id="from_date" name="from_date" placeholder="yyyy-mm-dd"
                               autocomplete="false" readonly value="{{ $from_date ?? "" }}">
                        <span>~</span>
                        <input type="text" id="to_date" name="to_date" placeholder="yyyy-mm-dd"
                               autocomplete="false" readonly value="{{ $to_date ?? "" }}">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>
            </div>

            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="text" name="keyword" placeholder="기부자명 검색">
                        <button type="submit" value="조회"><i class="fas fa-search"></i>검색</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table>
                <thead>
                <tr>
                    <th class="privacyAgreement-thd-01">선택</th>
                    <th class="privacyAgreement-thd-02">기부자명</th>
                    <th class="privacyAgreement-thd-03">전화번호</th>
                    <th class="privacyAgreement-thd-04">분류</th>
                    <th class="privacyAgreement-thd-05">내용</th>
                    <th class="privacyAgreement-thd-06 ">동의날짜</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($lists as $list)
                    <tr>
                        <td class="privacyAgreement-thd-01">
                            <input type="checkbox" name="id" class="check-box_circle" value="{{ $list->id }}">
                        </td>
                        <td class="privacyAgreement-thd-02">{{ $list->name ?: "익명" }}</td>
                        <td class="privacyAgreement-thd-03">{{ $list->tel ?: "익명" }}</td>
                        <td class="privacyAgreement-thd-04">{{ $list->menu }}</td>
                        <td class="privacyAgreement-thd-05 text-align_left">
{{--                            <a href="/b1BjW55p/privacy/agreement/{{ $list->id }}">--}}
                                {{ $list->category }}
{{--                            </a>--}}
                        </td>
                        <td class="privacyAgreement-thd-06">
                            {{ $list->created_at }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            내역이 없습니다
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}
            </div>

        </div>{{-- .contents-list end --}}

        <div class="btn-wrap btn-index btn-wide">
            <form action="/{{ $adminUrlPrefix }}/excel/export/privacy/agreement" method="post">
                @csrf
                <button>
                    <i class="fas fa-i-cursor"></i>엑셀 다운로드
                </button>
            </form>
        </div>
    </div>{{-- .contents-body end --}}


@endsection
