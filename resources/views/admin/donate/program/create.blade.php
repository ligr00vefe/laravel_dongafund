@extends("layouts/admin")

@section("title")
    기부 프로그램 관리 신규 작성
@endsection

@push("scripts")
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
@endpush

@section("content")
    <div class="contents-header">
        @include("admin.donate.program.include.categories")
    </div>{{-- .contents-header end  --}}

    <div class="contents-body">
        <form action="{{ $action }}" method="post" onsubmit="return validate(this)" enctype="multipart/form-data">
            @csrf
            @if (isset($edit))
                @method("put")
                <input type="hidden" name="id" value="{{ $program->id ?? "" }}">
            @endif

            <div class="contents-write">

                <table>
                    <tbody>
                    <tr>
                        <th>발전기금 코드</th>
                        <td>
                            <input type="text" name="donation_code" placeholder="" value="{{ $program->donation_code ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>프로그램명</th>
                        <td>
                            <input type="text" name="subject" placeholder="" value="{{ $program->subject ?? "" }}" maxlength="80">
                        </td>
                    </tr>
                    <tr>
                        <th>노출순서</th>
                        <td>
                            <input type="text" name="order" class="input-fs-15" value="{{ $program->order ?? "" }}"
                                   placeholder="노출순서를 기입해야 활성화되며 노출순서가 높을 수록 먼저 노출됩니다.">
                        </td>
                    </tr>
                    <tr>
                        <th>기부방식</th>
                        <td class="">
                            <div>
                                <input type="checkbox" name="donation_type1" value="1" id="donate-regular" {{ focused($program->donation_type1 ?? "", 1, "checked") }}>
                                <label for="donate-regular">정기기부</label>

                                <input type="checkbox" name="donation_type2" value="1" id="donate-temporary" {{ focused($program->donation_type2 ?? "", 1, "checked") }}>
                                <label for="donate-temporary">일시기부</label>

                                <input type="checkbox" name="donation_type3" value="1" id="donate-installment" {{ focused($program->donation_type3 ?? "", 1, "checked") }}>
                                <label for="donate-installment">분할납부</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>납입방법</th>
                        <td class="">
                            <div>
                                <input type="hidden" name="payment_method">
                                <input type="checkbox" name="payment_method_checked" value="무통장입금" id="pay-temp"
                                    {{ stringArrayChecked($program->payment_method ?? "", ",", "무통장입금") }}
                                >
                                <label for="pay-temp">무통장입금</label>

                                <input type="checkbox" name="payment_method_checked" value="자동이체" id="pay-auto"
                                    {{ stringArrayChecked($program->payment_method ?? "", ",", "자동이체") }}
                                >
                                <label for="pay-auto">자동이체</label>

                                <input type="checkbox" name="payment_method_checked" value="신용카드" id="pay-creadit"
                                    {{ stringArrayChecked($program->payment_method ?? "", ",", "신용카드") }}
                                >
                                <label for="pay-creadit">신용카드</label>
                            </div>
                            <div>
                                <input type="checkbox" name="payment_method_checked" value="카카오페이" id="pay-kakao"
                                    {{ stringArrayChecked($program->payment_method ?? "", ",", "카카오페이") }}
                                >
                                <label for="pay-kakao">카카오페이</label>

                                <input type="checkbox" name="payment_method_checked" value="네이버페이" id="pay-naver"
                                    {{ stringArrayChecked($program->payment_method ?? "", ",", "네이버페이") }}
                                >
                                <label for="pay-naver">네이버페이</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>노출분류</th>
                        <td class="">
                            <div>
                                <input type="hidden" name="categories">
                                <input type="checkbox" name="categories_checked" value="주요 캠페인 지원" id="ckb-campaign"
                                    {{ stringArrayChecked($program->categories ?? "", ",", "주요 캠페인 지원") }}
                                >
                                <label for="ckb-campaign">주요 캠페인 지원</label>

                                <input type="checkbox" name="categories_checked" value="학생 지원" id="ckb-student"
                                    {{ stringArrayChecked($program->categories ?? "", ",", "학생 지원") }}
                                >
                                <label for="ckb-student">학생 지원</label>

                                <input type="checkbox" name="categories_checked" value="연구 지원" id="ckb-research"
                                    {{ stringArrayChecked($program->categories ?? "", ",", "연구 지원") }}
                                >
                                <label for="ckb-research">연구 지원</label>
                            </div>
                            <div>
                                <input type="checkbox" id="collegeMajorCheck" name="categories_checked" value="단과대/학과 지원"
                                    {{ stringArrayChecked($program->categories ?? "", ",", "단과대/학과 지원") }}
                                >
                                <label for="collegeMajorCheck">단과대/학과 지원</label>

                                <input type="checkbox" name="categories_checked" value="대학생활 지원" id="ckb-life"
                                    {{ stringArrayChecked($program->categories ?? "", ",", "대학생활 지원") }}
                                >
                                <label for="ckb-life">대학생활 지원</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>단대/학과 분류</th>
                        <td class="select-box">
                            <select name="college" id="select-collage">
                                <option value="">단과대학을 선택해 주십시오</option>
                                @foreach(college_type() as $key => $value) {{-- DB에 고정적으로 들어있기 때문에 무조건 가져온다--}}
                                <option value="{{$value->college}}" @if(!empty($program->college)){{focused($program->college, $value->college, "selected")}} @endif>{{$value->college}}</option>
                                @endforeach
                            </select>
                            <select name="major" id="select-department">
                                <option value="">학과를 선택해 주십시오</option>
                                @foreach(department_type() as $key => $value)
                                    @continue(empty($value->department))
                                    <option value="{{$value->department}}" @if(!empty($program->department)) {{focused($program->department, $value->department, "selected")}} @endif >{{$value->department}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>기부금액 지정 여부</th>
                        <td class="">
                            <div>
                                <input type="radio" name="fixing_check" value="1" id="rd-assign" {{ focused($program->fixing_check ?? "", 1, "checked") }}>
                                <label for="rd-assign">지정</label>

                                <input type="radio" name="fixing_check" value="2" id="rd-assign-x" {{ focused($program->fixing_check ?? 2, 2, "checked") }}>
                                <label for="rd-assign-x">비지정</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>지정 기부금액</th>
                        <td>
                            <input type="text" id="fixing_price" name="fixing_price" disabled value="{{ $program->fixing_price ?? "" }}">
                        </td>
                    </tr>
                    <tr>
                        <th>아이콘 업로드</th>
                        <td class="file-upload">
                            <div class="file-part01 fileSelector" data-target="icon">파일선택</div>
                            <div class="file-part02" id="icon_file_name">
                                {{ getAttach($program->icon ?? "")->original_name ?? "" }}
                            </div>
                            <input type="file" id="icon" name="icon" class="dis-none" accept="image/*">
                        </td>
                    </tr>
                    <tr>
                        <th>대표이미지 업로드</th>
                        <td class="file-upload">
                            <div class="file-part01 fileSelector" data-target="thumbnail">파일선택</div>
                            <div class="file-part02" id="thumbnail_file_name">
                                {{ getAttach($program->thumbnail ?? "")->original_name ?? "" }}
                            </div>
                            <input type="file" id="thumbnail" name="thumbnail" class="dis-none" accept="image/*">
                        </td>
                    </tr>
                    <tr>
                        <th class="textarea-wrap">설명 텍스트</th>
                        <td class="textarea-wrap">
                            @include("_include.editor.ckeditor5",  [
                                        "editor_name" => "contents",
                                        "comment" => false,
                                        "image" => true,
                                        "contents" => $program->contents ?? ""
                                    ])
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>{{-- .contents-write end --}}

            <div class="btn-wrap btn-create">
                <a href="/b1BjW55p/donate/program?{{ $querystring }}" class="btn-cancel"><i class="fas fa-undo"></i>취소</a>
                <button class="btn-save btn-donate-submit"><i class="fas fa-save"></i>저장</button>
            </div>

        </form>

    </div>{{-- .contents-body end --}}


    <script>

        // 기부금액 지정/비지정
        const fixingPrice = document.querySelector("input[name='fixing_price']");
        document.querySelectorAll("input[name='fixing_check']").forEach (function(i) {
            i.addEventListener("change", function () {
                fixingPrice.disabled = this.value != 1;
            })
        })

        // 수정일때 단과대/학과지원 체크되어있다면 디시블 펄스 주기
        document.addEventListener("DOMContentLoaded", function () {
            const collegeMajorCheck = document.getElementById("collegeMajorCheck");

            if (collegeMajorCheck.checked) {
                document.getElementById("select-collage").disabled = false;
                document.getElementById("select-department").disabled = false;
            }

            // 기부금 지정이면 기부금액 디시블펄스
            if (document.getElementById("rd-assign").checked) {
                fixingPrice.disabled = false;
            }

        })

        function validate (f) {

            let payment_method = "";
            let categories = "";

            f.payment_method_checked.forEach(function(v) {
                if (!v.checked) return;
                if (payment_method != "") payment_method += ",";
                payment_method += v.value;
            })

            f.categories_checked.forEach (function (v) {
                if (!v.checked) return;
                if (categories != "") categories += ",";
                categories += v.value;
            })

            var msg = "";
            msg = f.subject.value == "" ? "프로그램명을 입력해주세요." : msg;
            msg = !f.donation_type1.checked && !f.donation_type2.checked && !f.donation_type3.checked ? "기부방식을 한 가지 이상 선택해주세요" : msg;
            msg = f.donation_type1.value == "" && f.donation_type2.value == "" && f.donation_type3.value == "" ? "기부방식을 한 가지 이상 선택해주세요" : msg;
            msg = payment_method == "" ? "납입방법을 한 가지 이상 선택해주세요" : msg;
            msg = categories == "" ? "노출분류를 한 가지 이상 선택해주세요" : msg;
            if (document.getElementById("collegeMajorCheck").checked) {
                msg = f.college.value == "" ? "단과대학을 선택해 주십시오" : msg;
                /*msg = f.major.value == "" ? "학과를 선택해 주십시오" : msg;*/
            }
            msg = !f.fixing_check.value ? "기부금액 지정 여부를 선택해주세요" : msg;
            if (f.fixing_check.value == 1) {
                msg = f.fixing_price.value == "" ? "지정 기부금액을 입력해주세요" : msg;
            }

            f.payment_method.value = payment_method;
            f.categories.value = categories;

            if (msg != "") {
                alert(msg);
                return false;
            }

        }

        /* 단과대/학과 선택시 단대/학과 분류 활성화 시키기 */
        document.getElementById("collegeMajorCheck").onclick = function () {
            if (this.checked) {
                document.getElementById("select-collage").disabled = false;
                document.getElementById("select-department").disabled = false;
            } else {
                document.getElementById("select-collage").disabled = true;
                document.getElementById("select-department").disabled = true;
            }
        }


        document.querySelectorAll(".fileSelector").forEach(function (v) {
            v.onclick = function () {
                const $inputFile = document.querySelector("#" + this.dataset.target);
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
            document.querySelector("#thumbnail_file_name").innerText = filename;
        })

        document.querySelector("#icon").addEventListener("change", function () {
            const filename = this.files[0].name;
            if (this.files[0].size >= 10485760) {
                alert("파일용량은 10mb 이상 업로드 할 수 없습니다.");
                this.value = "";
                return false;
            }
            document.querySelector("#icon_file_name").innerText = filename;
        })

    </script>

@endsection
