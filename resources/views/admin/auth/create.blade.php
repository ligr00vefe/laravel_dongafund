@extends("layouts/admin")

@section("title")
    관리자 권한관리  <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 신규등록/수정
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="contents-body contents-authCreate">
        <form action="{{ $action }}" method="post">
        @csrf
        @if(isset($edit))
            @method("put")
        @endif

        <div class="contents-write">
            <table>
                <tbody>
                <tr>
                    <th>직번</th>
                    <td>
                        <input type="text" name="account_id" placeholder="" value="{{ $post->account_id ?? "" }}" {{ isset($post->account_id) ? "readonly" : "" }}>
                    </td>
                </tr>
{{--                    <tr>--}}
{{--                        <th>성명</th>--}}
{{--                        <td>--}}
{{--                            <input type="text" name="name" placeholder="홍길동">--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                <tr>
                    <th>부여권한</th>
                    <td class="">
                        <div>
                            <input type="checkbox" name="permissions[]" value="기부금 관리" id="chk-01"
                                {{ strContain($post->permissions ?? "", "기부금 관리") ? "checked" : "" }}
                            >
                            <label for="chk-01">기부금 관리</label>

                            <input type="checkbox" name="permissions[]" value="예우대상자 풀" id="chk-02"
                                {{ strContain($post->permissions ?? "", "예우대상자 풀") ? "checked" : "" }}
                            >
                            <label for="chk-02">예우대상자 풀</label>

                            <input type="checkbox" name="permissions[]" value="기부 프로그램 관리" id="chk-03"
                                {{ strContain($post->permissions ?? "", "기부 프로그램 관리") ? "checked" : "" }}
                            >
                            <label for="chk-03">기부 프로그램 관리</label>
                        </div>
                        <div>
                            <input type="checkbox" name="permissions[]" value="전자모금함 관리" id="chk-04"
                                {{ strContain($post->permissions ?? "", "전자모금함 관리") ? "checked" : "" }}
                            >
                            <label for="chk-04">전자모금함 관리</label>

                            <input type="checkbox" name="permissions[]" value="컨텐츠 관리" id="chk-05"
                                {{ strContain($post->permissions ?? "", "컨텐츠 관리") ? "checked" : "" }}
                            >
                            <label for="chk-05">컨텐츠 관리</label>

                            <input type="checkbox" name="permissions[]" value="개인정보 관리" id="chk-06"
                                {{ strContain($post->permissions ?? "", "개인정보 관리") ? "checked" : "" }}
                            >
                            <label for="chk-06">개인정보 관리</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>권한만료일</th>
                    <td>
                        <input type="text" name="expire_date" placeholder="yyyy-mm-dd" value="{{ $post->expire_date ?? "" }}">
                    </td>
                </tr>
                <tr>
                    <th>접속IP</th>
                    <td>
                        <input type="text" name="ip" placeholder="" value="{{ $post->ip ?? "" }}">
                    </td>
                </tr>
                </tbody>
            </table>

        </div>{{-- .contents-write end --}}

        <div class="btn-wrap btn-create">
            <a href="/{{ $adminUrlPrefix }}/auth" class="btn-cancel"><i class="fas fa-undo"></i>취소</a>
            <button class="btn-save"><i class="fas fa-save"></i>저장</button>
        </div>
        </form>

    </div>{{-- .contents-body end --}}
@endsection
