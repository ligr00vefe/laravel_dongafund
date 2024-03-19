@extends("layouts/layout")

@section("title")
    우편물관리 - 발송인련번호 입력
@endsection

@push("scripts")

@endpush

@section("content")

    <section class="mail-number">

        <div class="mail-number-container">

            <form action="/mail/address">

            <div class="mail-number-contents">

                <div class="mail-number-contents__title">
                    <p>
                        <i class="fa fa-archive"></i>
                        <span class="dot-sky-bottom"></span>
                        우편물 관리
                    </p>
                </div>

                <div class="mail-number-contents__body">

                    <p>
                        우편물에 표기된 일련번호를 입력해 주십시오.
                    </p>

                    <div class="swp-input-wrap type-required">
                        <span>발송일련번호</span>
                        <div class="row">
                            <input type="text" name="number" id="number" placeholder="" value="">
                        </div>
                    </div>

                </div>

            </div>

            <div class="mail-number-bottom">

                <button>
                    <i class="fa fa-eye"></i>
                    조회
                </button>

            </div>

            </form>


        </div>

    </section>


@endsection
