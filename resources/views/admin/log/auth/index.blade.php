@extends("layouts/admin")

@section("title")
    관리자 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 권한부여 내역
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="contents-header">

    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="text" name="keyword" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-search"></i>검색</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table>
                <thead>
                <tr>
                    <th class="privacyInquire-thd-01">연번</th>
                    <th class="privacyInquire-thd-02">변경사항</th>
                    <th class="privacyInquire-thd-03">관리자 직번</th>
                    <th class="privacyInquire-thd-04">관리자명</th>
                    <th class="privacyInquire-thd-05">부여권한</th>
                    <th class="privacyInquire-thd-06">변경일자</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td class="privacyInquire-thd-01">
                            {{ $list->id }}
                        </td>
                        <td class="privacyInquire-thd-02">
                            {{ $list->action }}
                        </td>
                        <td class="privacyInquire-thd-03">
                            {{ $list->target ?? "" }}
                        </td>
                        <td class="privacyInquire-thd-04">
                            {{ $list->name ?? "" }}
                        </td>
                        <td class="privacyInquire-thd-05 text-align_left">
                            {{ $list->comment }}
                        </td>
                        <td class="privacyInquire-thd-06">
                            {{ date("Y-m-d H:i:s", strtotime($list->created_at)) }}
                        </td>
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
            <form action="/{{ $adminUrlPrefix }}/excel/export/log/adminPermission" method="post">
                @csrf
                <button class="btn-excel-down">
                    <i class="fas fa-file-excel"></i>
                    목록 다운로드
                </button>
            </form>
            {{--<a href="javascript:void(0)" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>--}}
        </div>
    </div>{{-- .contents-body end --}}

@endsection
