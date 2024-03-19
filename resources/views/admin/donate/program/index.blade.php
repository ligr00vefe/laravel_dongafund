@extends("layouts/admin")

@section("title")
    기부 프로그램 관리
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="contents-header">
        @include("admin.donate.program.include.categories")
    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">
            <div class="search-con__left"></div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="hidden" name="category" value="{{ $category }}">
                        <input type="text" name="keyword" value="{{ $keyword ?? "" }}" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table>
                <thead>
                    <tr>
                        <th class="donateProgram-thd-01">선택</th>
                        <th class="donateProgram-thd-02">작성순서</th>
                        <th class="donateProgram-thd-03">기금코드</th>
                        <th class="donateProgram-thd-04">프로그램명</th>
                        <th class="donateProgram-thd-05 vertical-align_bottom">정기기부</th>
                        <th class="donateProgram-thd-06 ">지원방식 일시기부</th>
                        <th class="donateProgram-thd-07 vertical-align_bottom">분할납부</th>
                        <th class="donateProgram-thd-08">노출분류</th>
                        <th class="donateProgram-thd-09">노출순서</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $list)
                        <tr>
                            <td class="donateProgram-thd-01">
                                <input type="checkbox" name="check[{{ $list->id }}]" class="check-box_circle" value="{{ $list->id }}">
                            </td>
                            <td class="donateProgram-thd-02">
                                {{ $list->id ?? "" }}
                            </td>
                            <td class="donateProgram-thd-03">
                                {{ $list->donation_code }}
                            </td>
                            <td class="donateProgram-thd-04 text-align_left">
                                <a href="/b1BjW55p/donate/program/{{ $list->id }}/edit?{{ $querystring }}">
                                    {{ $list->subject }}
                                </a>
                            </td>
                            <td class="donateProgram-thd-05">
                                <input type="checkbox" name="donation_type1[{{ $list->id }}]" value="1" {{ $list->donation_type1 == 1 ? "checked" : "" }}>
                            </td>
                            <td class="donateProgram-thd-06">
                                <input type="checkbox" name="donation_type2[{{ $list->id }}]" value="1" {{ $list->donation_type2 == 1 ? "checked" : "" }}>
                            </td>
                            <td class="donateProgram-thd-07">
                                <input type="checkbox" name="donation_type3[{{ $list->id }}]" value="1" {{ $list->donation_type3 == 1 ? "checked" : "" }}>
                            </td>
                            <td class="donateProgram-thd-08 text-align_left">
                                {{ $list->categories ?? "" }}
                            </td>
                            <td class="donateProgram-thd-09">
                                {{ $list->order }}
                            </td>
{{--                            <td class="donateProgram-thd-10">--}}
{{--                                <a href="{{ route("admin.donate.program.show", [ "id" => $list->id ]) }}">--}}
{{--                                    <i class="fas fa-window-restore"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                프로그램이 없습니다
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}
            </div>

        </div>{{-- .contents-list end --}}

        <div class="btn-wrap btn-index">
            <form action="/b1BjW55p/donate/program/update" method="post" onsubmit="return s_update(this)">
                @csrf
                <input type="hidden" name="querystring" value="{{ $querystring }}">
                <button class="btn-update"><i class="fas fa-eye-slash"></i>선택수정</button>
            </form>
            <form action="/b1BjW55p/donate/program/s_destroy" method="post" onsubmit="return s_destroy(this)">
                @csrf
                <input type="hidden" name="querystring" value="{{ $querystring }}">
                <button class="btn-destroy"><i class="fas fa-eye-slash"></i>선택삭제</button>
            </form>
            <a href="javascript:void(0)" class="btn-excel"><i class="fas fa-i-cursor"></i>엑셀 업로드</a>
            <a href="/b1BjW55p/donate/program/create" class="btn-register"><i class="fas fa-i-cursor"></i>신규 등록</a>
        </div>
    </div>{{-- .contents-body end --}}

    <script>
        function s_destroy(f){
            let _check = document.querySelectorAll("input[name^='check']:checked");
            if (_check.length === 0) {
                alert("프로그램을 선택해주세요");
                return false;
            }

            _check.forEach(function(i, v){
                if (!i.checked) return;

                const id = i.value;

                const $id = document.createElement("input");
                $id.setAttribute("type", "hidden");
                $id.setAttribute("name", "id[]");
                $id.setAttribute("value", id);
                f.appendChild($id);

            })
            return true;
        }




        function s_update(f)
        {
            let _check = document.querySelectorAll("input[name^='check']:checked");
            if (_check.length == 0) {
                alert("프로그램을 선택해주세요");
                return false;
            }

            _check.forEach(function (i,v) {

                if (!i.checked) return;

                const id = i.value;

                const $id = document.createElement("input");
                $id.setAttribute("type", "hidden");
                $id.setAttribute("name", "id[]");
                $id.setAttribute("value", id);
                f.appendChild($id);

                let donation_type1 = document.querySelector("input[name='donation_type1["+ id +"]']");
                let donation_type2 = document.querySelector("input[name='donation_type2["+ id +"]']");
                let donation_type3 = document.querySelector("input[name='donation_type3["+ id +"]']");

                if (donation_type1.checked) {
                    const $donation_type1 = document.createElement("input");
                    $donation_type1.setAttribute("type", "hidden");
                    $donation_type1.setAttribute("name", donation_type1.name);
                    $donation_type1.setAttribute("value", donation_type1.value);
                    f.appendChild($donation_type1);
                }

                if (donation_type2.checked) {
                    const $donation_type2 = document.createElement("input");
                    $donation_type2.setAttribute("type", "hidden");
                    $donation_type2.setAttribute("name", donation_type2.name);
                    $donation_type2.setAttribute("value", donation_type2.value);
                    f.appendChild($donation_type2);
                }

                if (donation_type3.checked) {
                    const $donation_type3 = document.createElement("input");
                    $donation_type3.setAttribute("type", "hidden");
                    $donation_type3.setAttribute("name", donation_type3.name);
                    $donation_type3.setAttribute("value", donation_type3.value);
                    f.appendChild($donation_type3);
                }
            })

            return true;
        }
    </script>

@endsection
