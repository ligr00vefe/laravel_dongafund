@extends("layouts/admin")

@section("title")
    관리자 권한관리
@endsection

@push("scripts")

@endpush


@section("content")
    <div class="contents-body contents-authIndex">
        <div class="search-wrap">
            <div class="search-con__left">
            </div>
            <div class="search-con__right">
                <div class="search-bar">
                    <form action="">
                        <input type="text" name="keyword" placeholder="">
                        <button type="submit" value="조회"><i class="fas fa-search"></i>검색</button>
                    </form>
                </div>{{-- .search-bar end --}}
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list contents-privacyAuth">
            <table>
                <thead>
                <tr>
                    <th class="privacyAuth-thd-01">선택</th>
                    <th class="privacyAuth-thd-02">번호</th>
                    <th class="privacyAuth-thd-03">직번/아이디</th>
                    <th class="privacyAuth-thd-04">성명</th>
                    <th class="privacyAuth-thd-05">보유권한</th>
                    {{--<th class="privacyAuth-thd-06">권한만료</th>--}}
                    <th class="privacyAuth-thd-07">수정</th>
                    <th class="privacyAuth-thd-07">삭제</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($lists as $list)
                    <tr>
                        <td class="privacyAuth-thd-01">
                            <input type="checkbox" name="id[]" value="{{ $list->id }}" class="check-box_circle">
                        </td>
                        <td class="privacyAuth-thd-02">
                            {{ $list->id }}
                        </td>
                        <td class="privacyAuth-thd-03">
                            {{ $list->account_id }}
                        </td>
                        <td class="privacyAuth-thd-04">
                            {{ $list->name ?? "" }}
                        </td>
                        <td class="privacyAuth-thd-05 text-align_left">
                            {{ $list->permissions }}
                        </td>
                        {{--<td class="privacyAuth-thd-06">2021.12.31.</td>--}}
                        <td class="privacyAuth-thd-07">
                            @if (isset($list->id))
                            <a href="/{{ $adminUrlPrefix }}/auth/{{ $list->id }}/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @else
                                <i class="fas fa-edit"></i>
                            @endif
                        </td>
                        <td class="privacyAuth-thd-08">
                            @if (isset($list->id))
                            <form action="/{{$adminUrlPrefix}}/auth/{{$list->id }}" method="post" onsubmit="return deleteValidation(this)">
                                @csrf
                                @method("delete")
                                <button>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @else
                                <i class="fas fa-trash-alt"></i>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
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

        <div class="btn-wrap btn-index">

            <a href="/{{ $adminUrlPrefix }}/log/auth" class="float-left">
                <i class="fa fa-eye"></i>
                권한부여 내역 조회
            </a>

            <button id="selectionDelete" class="btn-update"><i class="fas fa-trash-alt"></i>선택삭제</button>
            {{--<a href="javascript:void(0)" class="btn-excel-down"><i class="fas fa-i-cursor"></i>엑셀 다운로드</a>--}}
            <a href="/{{ $adminUrlPrefix }}/auth/create" class="btn-register"><i class="fas fa-i-cursor"></i>신규등록</a>
        </div>
    </div>{{-- .contents-body end --}}

    <script>

        function deleteValidation (f) {
            if (!confirm("삭제하시겠습니까?")) {
                return false;
            }
        }

        document.getElementById("selectionDelete").addEventListener("click", function () {

            if (!confirm("선택한 관리자의 권한을 지우시겠습니까?")) {
                return false;
            }

            const checked = document.querySelectorAll("input[name='id[]']:checked");
            let ids = "";

            checked.forEach(function (v) {
                if (v.value == "") return true;
                ids += ids == "" ? v.value : "," + v.value;
            })

            if (ids == "") {
                alert("권한이 없는 관리자입니다.");
                return false;
            }

            axios.post("/" + adminUrlPrefix + "/auth/delete", {
                _method: "delete",
                ids: ids
            })
                .then(function (response) {
                    if (response.data.result == 1) {
                        alert("권한이 삭제되었습니다");
                        location.reload();
                    }
                })

        })
    </script>
@endsection
