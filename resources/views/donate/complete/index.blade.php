@extends("layouts/layout")

@section("title")
    결제완료
@endsection

@push("scripts")

@endpush

@section("content")

    <section class="donate">

        <div class="donate-head">
            <div class="head-background" style="background-image:
                url({{
                    $thumbnail_id != 0
                    ? "https://prefund.donga.ac.kr/storage/" .getAttachPath($thumbnail_id)
                    : "/img/contract_top_noimg.jpg"
                    }})">

            </div>
        </div>

        <div class="donate-complete-body">
            <div class="donate-form">
                <div class="donate-form__top border-shadow">

                    <ul>
                        <li class="donate-complete-chongjang">
                            <img src="/img/chongjang_long.png" alt="동아대학교 총장 이해우">
                        </li>

                        <li class="donate-complete__text-thx">
                            <h3>
                                홍길동 님, <br>
                                동아대학교에 기부해 주셔서 감사드립니다.
                            </h3>
                            <p>
                                동아대학교는 1946년 개교 이래 많은 기부자분들의 지원으로 성장해 왔습니다.
                            </p>
                            <p>
                                보내주신 소중한 기부금은 기부자분께서 뜻하신 바와 같이 학내 지원이 필요한 적재적소에 배분하여 동아의 새로운 도약을 이루겠습니다.
                            </p>
                            <p>
                                고맙습니다.
                            </p>

                        </li>

                    </ul>

                    <div class="donate-complete__bottom">
                        <p>
                            동아대학교 총장
                            <img src="/img/signature_img.jpg" alt="동아대학교 총장 이해우 싸인">
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <div class="donate-complete-footer">

            <div class="donate-complete__announce">
                <h3>
                    기부약정이 완료 되었습니다
                    <span class="dot-orange-bottom"></span>
                </h3>

                <p>

                    @if ($type == "무통장입금")
                        아래의 계좌번호로 약정하신 금액을 입금해 주신 후 입금확인 전화를 걸어주시면 기부가 완료됩니다.
                    @else
                        <span style="text-align: center; width: 100%;">동아대학교에 기부해주셔서 감사합니다.</span>
                    @endif

                </p>

            </div>

        </div>

    </section>


    <script>

        document.onload = function ()
        {
            const kakaopaytest = "{{ $_GET['kakao'] ?? "" }}";
            const pg_token = "{{ $_GET['pg_token'] ?? "" }}";

            if (kakaopaytest != "") {
                window.opener.location.href = "/donate/kakaopay/return?id={{ $_GET['id'] }}&type={{ $_GET['type'] }}&pg_token=" + pg_token;
            }
        }

    </script>


@endsection
