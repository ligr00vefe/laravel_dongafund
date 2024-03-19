@extends("layouts/admin")

@section("title")
    컨텐츠 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 간행물 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 신규등록/수정
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="contents-header" style="margin-top:136px;">
    </div>{{-- .contents-header end --}}

    <form action="{{ $action }}" onsubmit="return registerFormCheck(this)" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($edit))
            @method("put")
            <input type="hidden" name="id" value="{{ $periodicals->id ?? "" }}">
        @endif
        <input type="hidden" name="from_date" value="{{ $periodicals->from_date ?? "" }}"></td>
        <div class="contents-body">
            <div class="contents-write">
                <table>
                    <tbody>
                    <tr>
                        <th>제목</th>
                        <td class="">
                            <input type="text" name="title" value="{{ $periodicals->title ?? "" }}" placeholder="동아100년동행">
                        </td>
                    </tr>

                    <tr>
                        <th>첨부파일 업로드</th>
                        <td class="file-upload">
                            <div class="file-part01 fileSelector" data-target="attachment1">파일선택</div>
                            <div class="file-part02" id="attachment1_name">{{ $file_name ?? "" }}</div>
                            <input type="file" id="attachment1" name="attachment1" class="dis-none">
                        </td>
                    </tr>

                    <tr>
                        <th>썸네일 업로드</th>
                        <td class="file-upload">
                            <div class="file-part01 fileSelector" data-target="thumbnail">파일선택</div>
                            <div class="file-part02" id="thumbnail_name">{{ $original_name ?? "" }}</div>
                            <input type="file" id="thumbnail" name="thumbnail" class="dis-none" accept="image/*">
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>{{-- .contents-write end --}}

            <div class="btn-wrap btn-create">
                <a href="/b1BjW55p/contents/periodicals" class="btn-cancel"><i class="fas fa-undo"></i>취소</a>
                <button class="btn-save"><i class="fas fa-save"></i>저장</button>
            </div>
        </div>{{-- .contents-body end --}}
    </form>

    <script>
        function registerFormCheck(form){

            var now = new Date();
            var nowYear = now.getFullYear();
            var nowMonth = now.getMonth() + 1;
            var nowDate = now.getDate();
            form.from_date.value = nowYear + "." + nowMonth + "." + nowDate;
            console.log(form.from_date.val());

            if(!/^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/i.test(form.from_date.value))
            {
                alert('날짜 형식이 틀립니다 다시 입력해 주세요');
                form.from_date.focus();
                return false;
            }


            if(!/\.(gif|jpg|jpeg|png)$/i.test(form.thumbnail.files[0].name) && !form.thumbnail.files.length < 1)
            {
                alert('썸네일은 gif, jpg, jpeg, png 파일만 선택해 주세요.');
                form.thumbnail.focus();
                return false;
            }

            if(form.title.value.length < 1)
            {
                alert('제목을 입력해 주세요');
                form.title.focus();
                return false;
            }

        }
    </script>


    <script>

        document.querySelectorAll(".fileSelector").forEach(function (v) {
            v.onclick = function () {
                const $inputFile = document.querySelector("#" + this.dataset.target);
                const $fileName = document.querySelector("#" + this.dataset.target + "_name");
                $inputFile.click();
            }
        });

        document.querySelector("#attachment1").addEventListener("change", function () {
            const filename = this.files[0].name;
            if (this.files[0].size >= 10485760) {
                alert("파일용량은 10mb 이상 업로드 할 수 없습니다.");
                this.value = "";
                return false;
            }
            document.querySelector("#attachment1_name").innerText = filename;
        });

        document.querySelector("#thumbnail").addEventListener("change", function () {
            const filename = this.files[0].name;
            if (this.files[0].size >= 10485760) {
                alert("파일용량은 10mb 이상 업로드 할 수 없습니다.");
                this.value = "";
                return false;
            }
            document.querySelector("#thumbnail_name").innerText = filename;
        });
    </script>
@endsection
