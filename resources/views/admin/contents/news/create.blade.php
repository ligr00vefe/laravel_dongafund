@extends("layouts/admin")

@section("title")
    컨텐츠 관리  <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 기부소식 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 신규등록/수정
@endsection

@push("scripts")
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
@endpush

@section("content")
    <div class="contents-header" style="margin-top:136px;">
    </div>{{-- .contents-header end --}}

    <form action="{{ $action }}" onsubmit="return registerFormCheck(this)" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($edit))
            @method("put")
            <input type="hidden" name="id" value="{{ $notice->id ?? "" }}">
        @endif
        <div class="contents-body">
            <div class="contents-write">
                <table>
                    <tbody>
                    <tr>
                        <th>분류</th>
                        <td class="">
                            <div>
                                <input type="radio" name="category" id="news-news" value="기부소식"
                                   {{ focused($notice->category ?? "", "기부소식", "checked") }}
                                >
                                <label for="news-news">기부소식</label>

                                <input type="radio" name="category" id="news-donga" value="동아뉴스"
                                    {{ focused($notice->category ?? "", "동아뉴스", "checked") }}
                                >
                                <label for="news-donga">동아뉴스</label>

                                <input type="radio" name="category" id="news-now" value="동아는 지금"
                                    {{ focused($notice->category ?? "", "동아는 지금", "checked") }}
                                >
                                <label for="news-now">동아는 지금</label>

                                <input type="radio" name="category" id="news-story" value="기부스토리"
                                    {{ focused($notice->category ?? "", "기부스토리", "checked") }}
                                >
                                <label for="news-story">기부스토리</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>취재</th>
                        <td>
                            <input type="text" name="space1" placeholder="기본값: 대외협력과 장소영" value="{{ $notice->space1 ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>사진</th>
                        <td>
                            <input type="text" name="space2" placeholder="기본값: 대외협력과 신부삼" value="{{ $notice->space2 ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>입력일자</th>
                        <td><input type="text" name="from_date" placeholder="yyyy-mm-dd" value="{{ $notice->from_date ?? "" }}"></td>
                    </tr>
                    <tr>
                        <th>소제목</th>
                        <td class="">
                            <input type="text" name="subtitle" placeholder="" value="{{ $notice->subtitle ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td class="">
                            <input type="text" name="title" placeholder="" value="{{ $notice->title ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>썸네일</th>
                        <td class="file-upload">
                            <div class="file-part01 fileSelector" data-target="thumbnail">파일선택</div>
                            <div class="file-part02" id="thumbnail_name">
                                {{ $original_name ?? "" }}
                            </div>
                            <input type="file" id="thumbnail" name="thumbnail" class="dis-none" accept="image/*">
                        </td>
                    </tr>

                    <tr>
                        <td class="editor-wrap " colspan="2">
                            @include("_include.editor.ckeditor5",  [
                                "editor_name" => "contents",
                                "comment" => false,
                                "image" => true,
                                "contents" => $notice->contents ?? "",
                                "height" => "740"
                            ])
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>{{-- .contents-write end --}}

            <div class="btn-wrap btn-create">
                <a href="/b1BjW55p/contents/news" class="btn-cancel"><i class="fas fa-undo"></i>취소</a>
                <button class="btn-save"><i class="fas fa-save"></i>저장</button>
            </div>
        </div>{{-- .contents-body end --}}

    </form>

    <script>
        function registerFormCheck(form){


            if(textEditor.data.get() < 1)
            {
                alert('내용을 입력해 주세요');
                textEditor.focus();
                return false;
            }

            if(form.category.value.length < 1)
            {
                alert('분류를 선택해 주세요');
                return false;
            }

            if(form.space1.value.length < 1)
            {
                alert('취재를 입력해 주세요');
                form.space1.focus();
                return false;
            }

            if(!/^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/i.test(form.from_date.value))
            {
                alert('날짜 형식이 틀립니다 다시 입력해 주세요');
                form.from_date.focus();
                return false;
            }


            if(!/\.(gif|jpg|jpeg|png|svg)$/i.test(form.thumbnail.files[0].name) && !form.thumbnail.files.length < 1)
            {
                alert('썸네일은 gif, jpg, jpeg, png 파일만 선택해 주세요.');
                form.thumbnail.focus();
                return false;
            }


            if(form.subtitle.value.length < 1)
            {
                alert('소제목을 입력해 주세요');
                form.subtitle.focus();
                return false;
            }

            if(form.title.value.length < 1)
            {
                alert('제목을 입력해 주세요');
                form.title.focus();
                return false;
            }

            if(form.contents.value.length < 1)
            {
                alert('내용을 입력해 주세요');
                return false;
            }



        }
    </script>


    <script>

        document.querySelectorAll(".fileSelector").forEach(function (v) {
            v.onclick = function () {
                const $inputFile = document.querySelector("#" + this.dataset.target);
                const $fileName = document.querySelector("#" + this.dataset.target + "_name")
                $inputFile.click();
            }
        })

        document.querySelector("#thumbnail").addEventListener("change", function () {
            const filename = this.files[0].name;
            if (this.files[0].size >= 10485760) {
                alert("파일용량은 10mb 이상 업로드 할 수 없습니다.");
                this.value = "";
                return false;
            }
            document.querySelector("#thumbnail_name").innerText = filename;
        })

    </script>
@endsection
