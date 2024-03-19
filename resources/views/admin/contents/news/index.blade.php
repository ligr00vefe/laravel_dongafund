@extends("layouts/admin")

@section("title")
    컨텐츠 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 기부소식
@endsection

@push("scripts")

@endpush


@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?: "focused" }} t1">
                <a href="/b1BjW55p/contents/news">
                    <i class="fas fa-layer-group"></i>전체보기
                </a>
            </li>
            <li class="{{ focused($category, "기부소식") }} t2">
                <a href="/b1BjW55p/contents/news?category=기부소식">
                    기부소식
                </a>
            </li>
            <li class="{{ focused($category, "동아뉴스") }} t3">
                <a href="/b1BjW55p/contents/news?category=동아뉴스">
                    동아뉴스
                </a>
            </li>
            <li class="{{ focused($category, "동아는 지금") }} t4">
                <a href="/b1BjW55p/contents/news?category=동아는 지금">
                    동아는 지금
                </a>
            </li>
            <li class="{{ focused($category, "기부스토리") }} t5">
                <a href="/b1BjW55p/contents/news?category=기부스토리">
                   기부스토리
                </a>
            </li>
        </ul>
    </div> {{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left"></div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="hidden" name="category" value="{{ $category ?? "" }}">
                        <input type="text" name="keyword" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table class="contentsNews-table">
                <thead>
                <tr>
                    <th class="contentsNews-thd-01">선택</th>
                    <th class="contentsNews-thd-02">번호</th>
                    <th class="contentsNews-thd-03">분류</th>
                    <th class="contentsNews-thd-04">제목</th>
                    <th class="contentsNews-thd-05">작성자</th>
                    <th class="contentsNews-thd-06">입력일자</th>
                    <th class="contentsNews-thd-07">조회</th>
                    <th class="contentsNews-thd-08">수정</th>
                    <th class="contentsNews-thd-09">삭제</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td class="contentsNews-thd-01">
                            <input type="checkbox" class="check-box_circle">
                        </td>
                        <td class="contentsNews-thd-02">{{ $list->id ?? "" }}</td>
                        <td class="contentsNews-thd-03">{{ $list->category ?? "" }}</td>
                        <td class="contentsNews-thd-04 text-align_left">
                            {{ $list->title ?? "" }}
                        </td>
                        <td class="contentsNews-thd-05">
                            {{ getName($id ?? "1") }}
                        </td>
                        <td class="contentsNews-thd-06">
                            {{ date("Y-m-d", strtotime($list->from_date ?? "")) }}
                        </td>
                        <td class="contentsNews-thd-07">
                            {{ $list->hits ?? "" }}
                        </td>
                        <td class="contentsNews-thd-08">
                            <a href="/b1BjW55p/contents/news/{{ $list->id ?? "" }}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="contentsNews-thd-09-thd-09">
                            <form action="/b1BjW55p/contents/news/{{ $list->id ?? "" }}" method="post">
                                @csrf
                                @method("delete")
                                <button>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
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
            <a href="javascript:void(0)" class="btn-update"><i class="fas fa-eye-slash"></i>선택수정</a>
            {{--<a href="javascript:void(0)" class="btn-excel"><i class="fas fa-i-cursor"></i>엑셀 업로드</a>--}}
            <a href="/b1BjW55p/contents/news/create" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>
        </div>
    </div>{{-- .contents-body end --}}
@endsection
