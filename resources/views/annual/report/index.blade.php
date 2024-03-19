@extends("layouts/layout")

@section("title")
    정기간행물
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div id="report-container" class="container">

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                  //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents-body">
                    @include ("annual.report.list")
                </div>

            </div>{{-- .page-contents end --}}

        </div>{{-- .sub-page-wrap end --}}

        <div class="page-footer">
            @include ("_include.donate")
        </div>

    </div>{{-- .container end --}}


@endsection
