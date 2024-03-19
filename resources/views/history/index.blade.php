@extends("layouts/layout")

@section("title")
    기부내역 조회
@endsection

@push("scripts")

@endpush

@section("content")
    <div class="m-top-100"></div>

    <div id="history-container" class="container">

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                   //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents-header">
                    <div class="ch-con ch-con__left">
                        <div class="donor-info">
                            <i class="fas fa-user"></i><span>기부자명</span><p>{{ $name }}</p>
                        </div>
                    </div>
                    <div class="ch-con ch-con__right">
                        <div class="donate-info">
                            <i class="fas fa-coins"></i><span>누적 기부금</span>
                            <p>
                                {{ number_format($total->price) }}
                            </p>
                            <p class="won-unit">원</p>
                        </div>
                    </div>
                </div>{{-- .contents-header end --}}

                <div class="contents__sub-header sub-introduce">
                    <div class="sh-con">
                        <div class="sh-con__left">
                            <div class="img-wrap">
                                <img src="/img/sub_introduce_img.png" alt="서브페이지 소개 사진">
                            </div>
                        </div>
                        <div class="sh-con__right">
                            <div class="text-wrap">
                                <div class="sub-header__title"><span>“{{ $name ?? "" }} 님,</span> 동아대학교에 기부해 주셔서 감사드립니다.”</div>
                                <div class="sub-header__content">동아대학교는 1946년 개교 이래 많은 기부자분들의 지원으로 성장해 왔습니다.<br/> 보내주신 소중한 기부금은 기부자분께서 뜻하신 바와 같이학내 지원이 필요한 적재적소에 배분하여 동아의 새로운 도약을 이루겠습니다. <br/>고맙습니다.</div>
                                <div class="sub-header__signature">
                                    <span>동아대학교 총장</span>
                                    <img src="/img/signature_img.jpg" alt="서명">
                                </div>
                            </div>
                        </div>
                    </div>{{-- .sh-con end --}}
                </div>{{-- .contents-sub-header.sub-instroduce end --}}

                <div class="contents-body">
                    @include("history.include.list")
                </div>{{-- .contents-body end --}}

            </div>{{-- .page-contents end --}}
        </div>{{-- .sub-page-wrap end --}}

        <div class="page-footer">
            @include ("_include.donate")
        </div>
    </div>{{-- .container end --}}

@endsection
