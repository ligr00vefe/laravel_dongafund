@extends("layouts/admin")

@section("title")
    개인정보 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 개인정보 조회 내역
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="/css/pickday_white.css">
@endpush

@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ focused($category, "all") }}">
                <a href="/b1BjW55p/privacy/inquire?admSubTopMenu=all">
                    전체보기
                </a>
            </li>
            <li class="">
                <a href="javascript:void(0)">
                    보기
                </a>
            </li>
            <li class="">
                <a href="javascript:void(0)">
                    수정
                </a>
            </li>
            <li class="">
                <a href="javascript:void(0)">
                    다운
                </a>
            </li>
        </ul>
    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left">
                <div class="search-date">
                    <form action="">
                        <input type="text" placeholder="yyyy-mm-dd" name="from_date" class="from_date" id="from_date" autocomplete="off">
                        <span>~</span>
                        <input type="text" placeholder="yyyy-mm-dd" name="to_date" class="to_date" id="to_date" autocomplete="off">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>
            </div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="text" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-search"></i>검색</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table>
                <thead>
                <tr>
                    <th class="privacyInquire-thd-01">선택</th>
                    <th class="privacyInquire-thd-02">직번</th>
                    <th class="privacyInquire-thd-03">성명</th>
                    <th class="privacyInquire-thd-07">분류</th>
                    <th class="privacyInquire-thd-05">경로</th>
                    <th class="privacyInquire-thd-06">접속날짜</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td class="privacyInquire-thd-01">
                            <input type="checkbox" class="check-box_circle">
                        </td>
                        <td class="privacyInquire-thd-02">{{ $list->account_id }}</td>
                        <td class="privacyInquire-thd-03">{{ $list->name }}</td>
                        <td class="privacyInquire-thd-07">{{ $list->action }}</td>
                        <td class="privacyInquire-thd-05 text-align_left">
                            http://prefund.donga.ac.kr{{ $list->path }}
                        </td>
                        <td class="privacyInquire-thd-06">{{ $list->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}
            </div>

        </div>{{-- .contents-list end --}}

        <div class="btn-wrap btn-index btn-wide">
            {{--<a href="javascript:void(0)" class="btn-update"><i class="fas fa-trash-alt"></i>선택삭제</a>--}}
            <a href="/{{ $adminUrlPrefix }}/excel/export/privacy/inquire" class="btn-excel-down"><i class="fas fa-i-cursor"></i>엑셀 다운로드</a>
            {{--<a href="javascript:void(0)" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>--}}
        </div>
    </div>{{-- .contents-body end --}}
@endsection
