@extends("layouts/layout")

@section("title")
    기부소식 - 글쓰기
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

        <div id="board-wrapper" class="container">

            <div class="news-wrap">

                {{--기부자라운지 헤더 //.page-contents 시작태그 포함--}}
                @include ("_include.lounge_head")

                </div>{{-- .page-contents end --}}

            <div class="create-page">
                    <form action="">

                        <table class="write-box">
                            <tbody>
                                <tr>
                                    <th><label for="wr-select-cate">분류</label></th>
                                    <td>
                                        <select name="wr_1" id="wr_select_cate" placeholder="선택하세요">
                                            <option value="전체보기">전체보기</option>
                                            <option value="기부소식">기부소식</option>
                                            <option value="동아는 지금">동아는 지금</option>
                                            <option value="동아뉴스">동아뉴스</option>
                                            <option value="기부스토리">기부스토리</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">입력일자</label>
                                    </th>
                                    <td>
                                        <input type="text" class="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">취재자</label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">촬영자 </label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">소제목</label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">제목</label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="">첨부파일</label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for=""></label>
                                    </th>
                                    <td>
                                        <input type="text">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>



            </div>{{-- .news-wrap end --}}
        </div>{{-- #board-wrapper end --}}

@endsection