@extends("layouts/admin")

@section("title")
    컨텐츠 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 협약서
@endsection

@php
    $limit = $_GET['limit'] ?? 15;
@endphp

@push("scripts")

@endpush


@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?: "focused" }} t1">
                <a href="/b1BjW55p/contents/contract">
                    <i class="fas fa-layer-group"></i>전체보기
                </a>
            </li>
            <li class="{{ focused($category, "기부소식") }} t2">
                <a href="/b1BjW55p/contents/contract?category=기부소식">
                    기부소식
                </a>
            </li>
            <li class="{{ focused($category, "동아뉴스") }} t3">
                <a href="/b1BjW55p/contents/contract?category=동아뉴스">
                    동아뉴스
                </a>
            </li>
            <li class="{{ focused($category, "동아는 지금") }} t4">
                <a href="/b1BjW55p/contents/contract?category=동아는 지금">
                    동아는 지금
                </a>
            </li>
            <li class="{{ focused($category, "기부스토리") }} t5">
                <a href="/b1BjW55p/contents/contract?category=기부스토리">
                    기부스토리
                </a>
            </li>
        </ul>
    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left"></div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="hidden" name="category" value="{{ $category ?? "" }}">
                        <input type="text" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table class="contentsContract-table">
                <thead>
                <tr>
                    <th class="contentsContract-thd-01">선택</th>
                    <th class="contentsContract-thd-02">번호</th>
                    <th class="contentsContract-thd-03">제목</th>
                    <th class="contentsContract-thd-04">상대기관</th>
                    <th class="contentsContract-thd-05">작성자</th>
                    <th class="contentsContract-thd-06">입력일자</th>
                    <th class="contentsContract-thd-07">다운로드</th>
                    <th class="contentsContract-thd-08">수정</th>
                    <th class="contentsContract-thd-09">삭제</th>
                </tr>
                </thead>
                <tbody>
                @if(count($lists) > 0)
                    @foreach ($lists as $list)
                        <tr>
                            <td class="contentsContract-thd-01">
                                <input type="checkbox" class="check-box_circle">
                            </td>
                            <td class="contentsContract-thd-02">{{ $list->space1 ?? "" }}</td>
                            <td class="contentsContract-thd-03 text-align_left">
                                {{ $list->title ?? "" }}
                            </td>
                            <td class="contentsContract-thd-04">
                                {{ $list->space2 ?? "" }}
                            </td>
                            <td class="contentsContract-thd-05">
                                {{ getName($id ?? "1") }}
                            </td>
                            <td class="contentsContract-thd-06">
                                {{ date("Y.m.d", strtotime($list->from_date ?? "")) }}
                            </td>
                            <td class="contentsContract-thd-07">
                                다운로드횟수
                            </td>
                            <td class="contentsContract-thd-08">
                                <a href="/b1BjW55p/contents/contract/{{ $list->id ?? "" }}/edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="contentsContract-thd-09">
                                <form action="/b1BjW55p/contents/contract/{{ $list->id ?? "" }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button>
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
            <a href="/b1BjW55p/contents/contract/create" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>
        </div>
    </div>{{-- .contents-body end --}}
@endsection
