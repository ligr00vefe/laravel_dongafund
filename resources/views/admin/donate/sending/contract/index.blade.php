@extends("layouts.admin")

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

        .sending-text {
            font-family: "paybooc-Bold";
            font-size: 16px;
            color: #555555;
            line-height: 26px;
        }

    </style>


    <div class="contents-body">

        <div class="excel-selector__wrap">

            <ul>
                <li class="sending-text">
                    <p>
                        XX건 발전기금 시스템 전송완료
                    </p>
                    <p>
                        ({{ date("Y-m-d H:i:s") }})
                    </p>
                </li>
                <li>
                    <a href="/{{ $adminUrlPrefix }}/donate/contract">
                        <i class="fa fa-undo"></i>
                        <span>
                            돌아가기
                        </span>
                    </a>
                </li>
            </ul>

        </div>

    </div>{{-- .contents-body end --}}


@endsection
