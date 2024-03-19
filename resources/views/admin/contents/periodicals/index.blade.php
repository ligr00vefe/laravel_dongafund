@extends("layouts/admin")

@section("title")
    컨텐츠 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 간행물
@endsection

@php
    $limit = $_GET['limit'] ?? 15;
@endphp

@push("scripts")

@endpush

@section("content")
    <div class="contents-header">
    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left"></div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="text" name="keyword" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table class="contentsPeriodicals-table">
                <thead>
                <tr>
                    <th class="contentsPeriodicals-thd-01">선택</th>
                    <th class="contentsPeriodicals-thd-02">번호</th>
                    <th class="contentsPeriodicals-thd-03">제목</th>
                    <th class="contentsPeriodicals-thd-04">작성자</th>
                    <th class="contentsPeriodicals-thd-05">입력일자</th>
                    <th class="contentsPeriodicals-thd-06">다운로드</th>
                    <th class="contentsPeriodicals-thd-07">수정</th>
                    <th class="contentsPeriodicals-thd-08">삭제</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($lists) > 0)
                        @foreach ($lists as $list)
                            <tr>
                                <td class="contentsPeriodicals-thd-01">
                                    <input type="checkbox" class="check-box_circle">
                                </td>
                                <td class="contentsPeriodicals-thd-02">{{ $list->id ?? "" }}</td>
                                <td class="contentsPeriodicals-thd-03 text-align_left">
                                    {{ $list->title ?? "" }}
                                </td>
                                <td class="contentsPeriodicals-thd-04">
                                    {{ getName($id ?? "1") }}
                                </td>
                                <td class="contentsPeriodicals-thd-05">
                                    {{ date("Y-m-d", strtotime($list->from_date ?? "")) }}
                                </td>
                                <td class="contentsPeriodicals-thd-06">
                                    다운로드횟수
                                </td>
                                <td class="contentsPeriodicals-thd-08">
                                    <a href="/b1BjW55p/contents/periodicals/{{ $list->id ?? "" }}/edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="contentsPeriodicals-thd-09">
                                    <form action="/b1BjW55p/contents/periodicals/{{ $list->id ?? "" }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" onclick="return deleteChk()">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="empoty_td">
                                게시물이 없습니다.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{--페이징--}}
            {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}

        </div>{{-- .contents-list end --}}

        <div class="btn-wrap btn-index btn-wide">
            <a href="javascript:void(0)" class="btn-update"><i class="fas fa-eye-slash"></i>선택수정</a>
            {{--<a href="javascript:void(0)" class="btn-excel"><i class="fas fa-i-cursor"></i>엑셀 업로드</a>--}}
            <a href="/b1BjW55p/contents/periodicals/create" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>
        </div>
    </div>{{-- .contents-body end --}}

    <script>
        function deleteChk() {
            var check = confirm("정말 삭제하시겠습니까?");

            if(check) {
                document.form.submit();
            }else { // 취소
                return false;
            }
        }
    </script>
@endsection
