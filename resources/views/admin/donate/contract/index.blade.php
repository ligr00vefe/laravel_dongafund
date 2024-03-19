@extends("layouts/admin")

@section("title")
    기부금 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 약정 관리
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="/css/pickday_white.css">
@endpush

@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?: "focused" }} t1">
                <a href="/b1BjW55p/privacy/agreement">
                    전체보기
                </a>
            </li>
            <li class="{{ focused($category, "홈페이지") }} t2">
                <a href="/b1BjW55p/privacy/agreement?category=약정서">
                   홈페이지
                </a>
            </li>
            <li class="{{ focused($category, "전자서명") }} t3">
                <a href="/b1BjW55p/privacy/agreement?category=전자서명">
                    키오스크
                </a>
            </li>
            <li class="{{ focused($category, "본인인증") }} t4">
                <a href="/b1BjW55p/privacy/agreement?category=본인인증">
                    서면약정서
                </a>
            </li>
        </ul>

        <div class="contract-user-status">

            <span>
                현재 최대 회원번호 20210000
            </span>

            <span>
                현재 최대 증서번호 20210000
            </span>

        </div>

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
                        <select class="contract-search arrow-hide" name="payment_method" id="payment_method">
                            <option value="" hidden>결제수단</option>
                        </select>
                        <select class="contract-search arrow-hide" name="payment_status" id="payment_status">
                            <option value="" hidden>결제상태</option>
                        </select>
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
                    <th class="">선택</th>
                    <th class="">약정경로</th>
                    <th class="">기부자명</th>
                    <th class="">기부 프로그램</th>
                    <th class="">기부금액</th>
                    <th class="">기부방식</th>
                    <th class="">결제수단</th>
                    <th class="">약정일시</th>
                    <th class="">약정상태</th>
                    <th class="">전송상태</th>
                    <th class="">상세</th>
                </tr>
                </thead>
                <tbody>
                @forelse($lists as $list)
                <tr>
                    <td>
                        <input type="checkbox" name="check[]" value="{{ $list->id }}">
                    </td>
                    <td>
                        {{ $list->contract_type }}
                    </td>
                    <td>
                        {{ $list->name }}
                    </td>
                    <td>
                        {{ $list->subject }}
                    </td>
                    <td>
                        {{ $list->donation_price }}
                    </td>
                    <td>
                        {{ $list->donation_type }}
                    </td>
                    <td>
                        {{ $list->payment_type }}
                    </td>
                    <td>
                        {{ $list->created_at }}
                    </td>
                    <td>
                        {{ $list->contract_status == "0" ? "약정보완" : "약정완료" }}
                    </td>
                    <td>
                        {{ $list->send_status_kor }}
                    </td>
                    <td>
                        <a href="/{{ $adminUrlPrefix }}/donate/contract/{{ $list->id }}">
                            <i class="fa fa-window-restore"></i>
                        </a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="11"></td>
                    </tr>
                @endforelse
                </tbody>
            </table>

{{--            <div class="paging-wrap">--}}
{{--                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}--}}
{{--            </div>--}}

        </div>{{-- .contents-list end --}}



        <div class="btn-wrap btn-index btn-wide">
            <a href="javascript:void(0)" class="btn-excel-down btn-float-left"><i class="fas fa-trash-alt"></i>서면약정서 삭제</a>

            <a href="/{{ $adminUrlPrefix }}/donate/excel/contract" class="btn-excel-down"><i class="fas fa-pen"></i>약정서 등록</a>
            <form action="/{{ $adminUrlPrefix }}/excel/export/contract" method="POST">
                @csrf
                <button class="btn-excel-down"><i class="fas fa-file-excel"></i>목록 다운로드</button>
            </form>
            <a href="/{{ $adminUrlPrefix }}/donate/sending/contract" class="btn-excel-down"><i class="fas fa-share-alt"></i>발전기금시스템 전송</a>
        </div>
    </div>{{-- .contents-body end --}}


@endsection
