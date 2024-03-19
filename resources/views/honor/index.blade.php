@extends("layouts/layout")

@section("title")
    기부자 예우 - 목록
@endsection

@push("scripts")

@endpush

@section("content")
    <div id="cz">
        <section id="common-content">
            <div class="common-wrap">
                <div id="main-block">
                    <div class="title-sector">
                        <h2>기부자 라운지</h2>
                        <p>명문사학으로 키우는 소중한 밑거름</p>
                    </div>

                        <div class="main-partition">

                            <div class="main-border-line">

                                @include("_include.lounge.sub")

                            <div class="content-sector">
                                <ul class="content-ul-selector">
                                    <li class="{{ focused($type2, "billion") }}"><a href="/honor?type=billion">30억원 이상</a></li>
                                    <li class="{{ focused($type2, "billion_02") }}"><a href="/honor?type=billion_02">10억원 이상</a></li>
                                    <li class="{{ focused($type2, "billion_03") }}"><a href="/honor?type=billion_03">1억원 이상</a></li>
                                    <li class="{{ focused($type2, "million") }}"><a href="/honor?type=million">1천만원대</a></li>
                                </ul>
                            </div>
                            @switch($type2)
                                @case('billion')
                                @include('honor.include.billion')
                                @break
                                @case('billion_02')
                                @include('honor.include.billion_02')
                                @break
                                @case('billion_03')
                                @include('honor.include.billion_03')
                                @break
                                @case('million')
                                @include('honor.include.million')
                                @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include("_include.donate")
    </div>
@endsection
