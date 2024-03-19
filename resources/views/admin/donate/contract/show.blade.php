@extends("layouts/admin")

@section("title")
    기부금 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 약정 관리
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="/css/pickday_white.css">
@endpush

@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?: "focused" }} t1">
                <a href="/b1BjW55p/privacy/agreement">
                    전체보기
                </a>
            </li>
            <li class="{{ focused($category, "홈페이지") }} t2">
                <a href="/b1BjW55p/privacy/agreement?category=약정서">
                   홈페이지
                </a>
            </li>
            <li class="{{ focused($category, "전자서명") }} t3">
                <a href="/b1BjW55p/privacy/agreement?category=전자서명">
                    키오스크
                </a>
            </li>
            <li class="{{ focused($category, "본인인증") }} t4">
                <a href="/b1BjW55p/privacy/agreement?category=본인인증">
                    서면약정서
                </a>
            </li>
        </ul>

        <div class="contract-user-status">

            <span>
                현재 최대 회원번호 20210000
            </span>

            <span>
                현재 최대 증서번호 20210000
            </span>

        </div>

    </div>{{-- .contents-header end --}}

    <style>
        .contract-contents {
            text-align: center;
            padding-top: 30px;
        }

        .contract-contents__box {
            display: inline-block;
            width: 942px;
            padding: 24px 36px;
            background-color: white;
            box-shadow: 0px 2px 4px #00000033;
            border-radius: 10px;
            text-align: left;
        }

        .contract-contents__box + .contract-contents__box {
            margin-top: 24px;
        }

        .contract-contents__box table {
            border-spacing: 8px;
            border-collapse: separate;
            font-family: paybooc-Bold;
            font-size: 16px;
            table-layout: fixed;
        }

        .contract-contents__box table th {
            background-color: #969696;
            color: white;
            font-weight: normal;
            width: 180px;
            height: 40px;
        }

        .contract-contents__box table td {
            min-width: 237px;
            width: 100%;
            border: 1px solid #969696;
        }

        .contract-contents__box table td input,
        .contract-contents__box table td a,
        .contract-contents__box table td p
        {
            border: none;
            font-family: "paybooc-Medium";
            font-size: 16px;
        }

        .contract-contents__box table th,
        .contract-contents__box table td {
            padding: 10px 24px;
        }

        .contract-contents__box #contract_file {
            display: none;
        }



        .contents-contract-list-wrap {
            margin-top: 20px;
            display: inline-block;
            width: 942px;
            padding: 24px 36px;
            background-color: white;
            box-shadow: 0px 2px 4px #00000033;
            border-radius: 10px;
            text-align: left;
        }

        .contents-contract-list-wrap table tr th {
            font-size: 16px;
            color: #555555;
            text-align: center;
            font-weight: normal;
        }

        .contents-contract-list-wrap.subscription-logs {

        }

        .contents-contract-list-wrap.subscription-logs table {
            font-size: 16px;
            color: #555555;
        }

        .contents-contract-list-wrap.subscription-logs table tr th {
            font-family: paybooc-Bold;
            height: 52px;
            border-bottom: 4px solid #019BDE;
        }

        .contents-contract-list-wrap.subscription-logs table tr td {
            height: 52px;
            text-align: center;
            font-family: "paybooc-Medium";
        }


        .contract-contents .btn-wrap {
            text-align: center;
        }

        .contract-contents .btn-wrap .anchor-back {
            width: 120px;
            height: 56px;
            background-color: #969696;
        }

        .contract-contents .btn-wrap .access-hold {
            width: 120px;
            height: 56px;
            background-color: #AE0000;
        }

        .padding-remove {
            padding: 0 !important;
        }

        label[for=contract_file] {
            padding: 0 25px;
            background-color: #c7c7c7;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            color: #6d6d6d;
            font-size: 16px;
            transform: rotate(
                -0.15deg
            );
        }

        input#contract_file_text {
            margin-left: 15px;
        }


    </style>


    <div class="contract-contents">

        <div class="contract-contents__box contract-contents-top">
            <table>
                <tr>
                    <th>
                        <p>약정경로</p>
                    </th>
                    <td>
                        <p>
                            <input type="text" value="{{ $data->contract_type }}" readonly>
                        </p>
                    </td>
                    <th>
                        <p>
                            약정일시
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->created_at }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            웹 약정번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->contract_code }}" readonly>
                    </td>
                    <th>
                        <p>
                        키오스크 약정번호
                        </p>
                    </th>
                    <td>
                        {{ "" }}
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                        시스템 회원번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ "미부여" }}" readonly>
                    </td>
                    <th>
                        <p>
                        시스템 증서번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ "미부여" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            서면약정서 사본
                        </p>
                    </th>
                    <td colspan="3" class="padding-remove">
                        <input type="file" name="contract_file" id="contract_file">
                        <label for="contract_file">파일선택</label>
                        <input type="text" id="contract_file_text" name="contract_file_text" value="....asdasd" readonly>
                    </td>
                </tr>
            </table>
        </div>

        <script>
            document.getElementById("contract_file").addEventListener("change", function (e) {
                var filename = e.target.files[0].name;
                document.getElementById("contract_file_text").value = filename;
            })
        </script>

        <div class="contract-contents__box contract-contents-middle1">

            <table>
                <tr>
                    <th>
                        <p>
                            기탁용도 (웹)
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->subject }}" readonly>
                    </td>
                    <th>
                        <p>
                            용도코드 (웹)
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->donation_code }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            기탁용도 (시스템)
                        </p>
                    </th>
                    <td>

                    </td>
                    <th>
                        <p>
                            기금코드(시스템)
                        </p>
                    </th>
                    <td>

                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle2">

            <table>
                <tr>
                    <th>
                        <p>
                            기부방식
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->donation_type }}" readonly>
                    </td>
                    <th>
                        <p>
                            기부금액
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->donation_price }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            분할횟수
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->divide_count ?? "" }}" readonly>
                    </td>
                    <th>
                        <p>
                            분납금액
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->divide_price ?? "" }}" readonly>
                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle3">

            <table>
                <tr>
                    <th>
                        <p>
                            회원구분
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->donator_type ?? "" }}" readonly>
                    </td>
                    <th>
                        <p>
                            익명구분
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->donator_type == "익명" ? "익명 " : "실명" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            성명
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->name ?? "" }}" readonly>
                    </td>
                    <th>
                        <p>
                            주민등록번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->regNumber ?? "" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            전화번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->tel ?? "" }}" readonly>
                    </td>
                    <th>
                        <p>
                            우편번호
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->zipcode ?? "" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            주소
                        </p>
                    </th>
                    <td colspan="3">
                        <input type="text" value="{{ $data->address1 ?? "" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            상세주소
                        </p>
                    </th>
                    <td colspan="3">
                        <input type="text" value="{{ $data->address2 ?? "" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            학교와의 관계
                        </p>
                    </th>
                    <td colspan="3">
                        <input type="text" value="{{ $data->relationship ?? "" }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            입학년도
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->enter_year ?? "" }}" readonly>
                    </td>
                    <th>
                        <p>
                            학과/이수과정
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->course ?? "" }}" readonly>
                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle4">

            <table>
                <tr>
                    <th>
                        <p>
                            서명방법
                        </p>
                    </th>
                    <td>
                        @if (isset($data->signature_type) && $data->signature_type == 1)
                            <input type="text" value="카카오페이" readonly>
                        @elseif (isset($data->signature_type) && $data->signature_type == 2)
                            <input type="text" value="일반전자서명" readonly>
                        @endif
                    </td>
                    <th>
                        <p>
                            서명결과
                        </p>
                    </th>
                    <td>
                        @if (isset($data->signature_pass) && $data->signature_pass == 1)
                            <input type="text" value="성공" readonly>
                        @elseif (isset($data->signature_pass) && $data->signature_pass == 2)
                            <input type="text" value="실패" readonly>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            서명일시
                        </p>
                    </th>
                    <td>
                        <input type="text" value="{{ $data->signature_datetime }}" readonly>
                    </td>
                    <th>
                        <p>
                            서명정보
                        </p>
                    </th>
                    <td>
                        @if ($data->signature_type == 1)
                            <p>
                                {{ $data->signedData ?? "" }}
                            </p>
                        @elseif ($data->signature_type == 2 && isset($data->signature_save_id))
                            <a href="/{{ getAttachPathWithOutRootPath($data->signature_save_id) }}">
                                사인데이터 파일
                            </a>
                        @endif
                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle5">
            <table>
                <tr>
                    <th>
                        <p>
                            필수정보 수집/이용
                        </p>
                    </th>
                    <td colspan="3">
                        @if (isset($data->receipt_check) && $data->receipt_check == 1)
                            <p>동의 ({{ $data->created_at }})</p>
                        @else
                            <p>미동의</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            선택정보 수집/이용
                        </p>
                    </th>
                    <td colspan="3">
                        @if (isset($data->benefit_check) && $data->benefit_check == 1)
                            <p>동의 ({{ $data->created_at }})</p>
                        @else
                            <p>미동의</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>
                            제3자 정보제공
                        </p>
                    </th>
                    <td colspan="3">
                        @if (isset($data->tax_check) && $data->tax_check == 1)
                            <p>동의 ({{ $data->created_at }})</p>
                        @else
                            <p>미동의</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="contract-contents__box contract-contents-middle6">

            <table>
                <tr>
                    <th>
                        <p>
                            SMS 발송
                        </p>
                    </th>
                    <td></td>
                    <th>
                        <p>
                            SMS 발송결과
                        </p>
                    </th>
                    <td></td>
                </tr>
                <tr>
                    <th>
                        <p>
                            SMS 발송번호
                        </p>
                    </th>
                    <td>

                    </td>
                    <th>
                        <p>
                            SMS 발송일시
                        </p>
                    </th>
                    <td>

                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle7">
            <table>
                <tr>
                    <th>
                        <p>
                            알림톡 발송
                        </p>
                    </th>
                    <td>

                    </td>
                    <th>
                        <p>
                            알림톡 발송결과
                        </p>
                    </th>
                    <td></td>
                </tr>
                <tr>
                    <th>
                        <p>
                            알림톡 발송번호
                        </p>
                    </th>
                    <td>

                    </td>
                    <th>
                        <p>
                            알림톡 발송일시
                        </p>
                    </th>
                    <td></td>
                </tr>

            </table>
        </div>

        <div class="contract-contents__box contract-contents-middle8">

            <table>
                <tr>
                    <th>
                        기부권유자
                    </th>
                    <td colspan="3">
                        <input type="text" value="{{ $data->host ?? "" }}">
                    </td>
                </tr>
            </table>

        </div>

        <div class="contract-contents__box contract-contents-middle9">

            @if ($data->payment_type == "무통장입금")

                <table>
                    <tr>
                        <th>
                            납입방법
                       </th>
                        <td>
                            <input type="text" value="{{ $data->payment_type }}">
                        </td>
                        <th>
                            입금예정일
                        </th>
                        <td>

                        </td>
                    </tr>
                </table>

            @elseif ($data->payment_type == "계좌이체") {{-- 현재 계좌이체는 없음 --}}

                <table>
                    <tr>
                        <th>
                            납입방법
                        </th>
                        <td>
                            <input type="text" value="{{ $data->payment_type }}">
                        </td>
                        <th>
                            정기결제일
                        </th>
                        <td>
                            <input type="text" value="매달 {{ $data->automatic_transfer_assign_day }}일">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            은행명
                        </th>
                        <td>
                            <input type="text" value="">
                        </td>
                        <th>
                            계좌번호
                        </th>
                        <td>
                            <input type="text" value="">
                        </td>
                    </tr>
                </table>

            @elseif ($data->payment_type == "신용카드")

                <table>
                    <tr>
                        <th>
                            납입방법
                        </th>
                        <td>
                            <input type="text" value="카드(나이스)" readonly>
                        </td>
                        <th>
                            정기결제일
                        </th>
                        <td>
                            <input type="text" value="매달 {{ $data->automatic_transfer_assign_day }}일" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            카드사
                        </th>
                        <td>
                            <input type="text" value="" readonly>
                        </td>
                        <th>
                            계좌번호
                        </th>
                        <td>
                            <input type="text" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            정기결제 키
                        </th>
                        <td colspan="3">
                            <input type="text" value="{{ $data->customer_uid }}" readonly>
                        </td>
                    </tr>
                </table>

            @elseif ($data->payment_type == "네이버페이")

                <table>
                    <tr>
                        <th>
                            납입방법
                        </th>
                        <td>
                            <input type="text" value="{{ $data->payment_type }}" readonly>
                        </td>
                        <th>
                            정기결제일
                        </th>
                        <td>
                            <input type="text" value="매달 {{ $data->automatic_transfer_assign_day }}일" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            정기결제 키
                        </th>
                        <td colspan="3">

                        </td>
                    </tr>
                </table>

            @elseif ($data->payment_type == "카카오페이")

                <table>
                    <tr>
                        <th>
                            납입방법
                        </th>
                        <td>
                            <input type="text" value="{{ $data->payment_type }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            정기결제일
                        </th>
                        <td>
                            <input type="text" value="매달 {{ $data->automatic_transfer_assign_day }}일" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            정기결제 키
                        </th>
                        <td colspan="3">
                            <input type="text" value="{{ $data->kakao_tid }}" readonly>
                        </td>
                    </tr>
                </table>

            @endif

        </div>


        <div class="contents-contract-list-wrap subscription-logs">

            <table>

                <tr>
                    <th>
                        <p>
                            결제상태
                        </p>
                    </th>
                    <th>
                        <p>
                            결제회차
                        </p>
                    </th>
                    <th>
                        <p>
                            웹 승인번호
                        </p>
                    </th>
                    <th>
                        <p>
                            납입관리번호
                        </p>
                    </th>
                    <th>
                        <p>
                            납입금액
                        </p>
                    </th>
                    <th>
                        <p>
                            납입일시
                        </p>
                    </th>
                </tr>
                @forelse ($logs as $log)
                    <tr>
                        <td>
                            {{ $log->status == 1 ? "결제완료" : "결제미완료" }}
                        </td>
                        <td>
                            {{ (count($logs) - $loop->iteration) + 1 }}회
                        </td>
                        <td>
                            {{ $log->id }}
                        </td>
                        <td>
                            {{ "납입관리번호" }}
                        </td>
                        <td>
                            {{ number_format(json_decode($log->returnValue)->response->amount) }}원
                        </td>
                        <td>
                            {{ date("y-m-d H:i:s", strtotime($log->created_at)) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            목록이 없습니다.
                        </td>
                    </tr>
                @endforelse

            </table>

        </div>

        <div class="btn-wrap">

            <a href="/b1BjW55p/donate/contract" class="anchor-back">
                <i class="fa fa-undo"></i>
                뒤로
            </a>
            <button type="button" class="access-hold">
                <i class="fa fa-pause-circle"></i>
                연동보류
            </button>
            <button type="button" class="access-anony">
                <i class="fa fa-share-alt"></i>
                익명처리 후 전송
            </button>
            <button type="button" class="access-do">
                <i class="fa fa-share-alt"></i>
                발전기금시스템 전송
            </button>

        </div>

    </div>


@endsection
