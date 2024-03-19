@extends("layouts/admin")

@section("title")
    엑셀 다운로드
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="contents-body">

        <section class="excel-reason">

            <div class="reason-wrap">

                <form action="" method="post" onsubmit="return validation(this)">
                    @csrf
                    <p>
                        개인정보보호를 위해 출력사유를 입력하셔야 엑셀 다운로드 가능합니다
                    </p>
                    <input name="reason" type="text" placeholder="출력사유를 입력해 주십시오">
                    <button>
                        <i class="fa fa-file-download"></i>
                        엑셀 다운로드
                    </button>

                </form>

            </div>

        </section>

        <script>
            function validation(f) {

                if (f.reason.value == "") {
                    alert("사유를 입력해주세요");
                    return false;
                }

                return true;
            }
        </script>

    </div>{{-- .contents-body end --}}

    <style>
        .excel-reason {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .excel-reason p {

            font-family: "paybooc-Bold";
            font-size: 16px;
            color: #555555;
            margin-bottom: 10px;

        }

        .excel-reason input {
            width: 400px;
            height: 56px;
            font-family: "paybooc-Medium";
            padding: 0 24px;
            font-size: 16px;
        }

        .excel-reason button {
            width: 200px;
            height: 56px;
            font-family: "paybooc-Bold";
            border: none;
            background-color: #0061AE;
            font-size: 16px;
            color: white;
        }

        .excel-reason button i {
            margin-right: 5px;
        }

    </style>

@endsection
