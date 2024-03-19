@extends("layouts/layout")

@section("title")
    우편물관리 - 주소 상태 변경
@endsection

@push("scripts")

@endpush

@section("content")

    <section class="mail-address">

        <div class="mail-address-container">

            <form action="/auth/change">

            <div class="mail-address-contents">

                <div class="mail-address-contents__title">
                    <p>
                        <i class="fa fa-archive"></i>
                        <span class="dot-sky-bottom"></span>
                        우편물 관리
                    </p>
                </div>

                <div class="mail-address-contents__body">

                    <p class="">
                        발송정보
                    </p>

                    <div class="swp-input-wrap swp-input-wrap--type-lock">
                        <span class="isValue">발송일련번호</span>
                        <div class="row">
                            <input type="text" name="number" id="number" placeholder="" value="1234567890" readonly>
                        </div>
                    </div>

                    <div class="swp-input-wrap swp-input-wrap--type-lock">
                        <span class="isValue">받는사람</span>
                        <div class="row">
                            <input type="text" name="receiver" id="receiver" placeholder="" value="홍**" readonly>
                        </div>
                    </div>

                    <div class="swp-input-wrap swp-input-wrap--type-lock">
                        <span class="isValue">받는곳</span>
                        <div class="row">
                            <input type="text" name="address" id="address" class="input--large" placeholder="" value="부산광역시 사하구 **** *** **" readonly>
                        </div>
                    </div>



                    <div class="m-both-10 border-bottom-1-gray"></div>


                    <p>
                        선택
                    </p>

                    <div class="button-wrap">
                        <button type="button" class="btn-type-select" data-type="empty">
                            <i class="fa fa-user-times"></i>
                            <span>받는 사람이 없습니다. (이사 등)</span>
                        </button>

                        <button type="button" class="btn-type-select" data-type="change">
                            <i class="fa fa-user-edit"></i>
                            <span>주소가 변경 되었습니다.</span>
                        </button>
                    </div>

                </div>

            </div>

            <div class="mail-address-bottom">

                <button class="btn-submit:blue">
                    <i class="fa fa-check"></i>
                    <span>확인</span>
                </button>

            </div>

            </form>

        </div>

    </section>

    <script>
        const typeSelector = document.querySelectorAll(".btn-type-select");

        typeSelector.forEach (function (i) {

            i.onclick = function () {
                const _focused = document.querySelector(".btn-type-select.--focused");
                if (_focused) {
                    document.querySelector(".btn-type-select.--focused").classList.remove("--focused");
                }
                i.classList.toggle("--focused");
            }

        });
    </script>


@endsection
