@extends("layouts.layout")

@section("title")
    로그인
@endsection

@push("scripts")

@endpush

@section("content")

    <section class="login-form">

        <div class="login-form-container">
            <form action="/auth/login" method="post">
                @csrf
                <input type="hidden" name="return" value="{{ $return }}">
                <div class="login-form-contents">

                    <div class="login-form-contents__title">
                        <p>
                            <i class="fa fa-user"></i>
                            <span class="dot-sky-bottom"></span>
                            로그인
                        </p>
                    </div>

                    <div class="login-form-contents__body">

                        <ul class="login-type__selector">
                            <li>
                                <button type="button">
                                    학생
                                </button>
                            </li>
                            <li>
                                <button type="button">
                                    교직원
                                </button>
                            </li>
                        </ul>

                        <div class="login-form__input-wrapper">
                            <div class="swp-input-wrap type-required">
                                <span>학번</span>
                                <input type="text" name="account_id" id="account_id" placeholder="" value="" min="6" max="7">
                            </div>
                        </div>

                        <div class="login-form__input-wrapper">
                            <div class="swp-input-wrap type-required">
                                <span>비밀번호</span>
                                <input type="password" name="password" id="password" placeholder="" value="">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="login-form-bottom">

                    <button>
                        <i class="fa fa-key"></i>
                        로그인
                    </button>

                </div>
            </form>

        </div>

    </section>

    <script>

        const typeSelector = document.querySelectorAll(".login-type__selector li button");

        typeSelector.forEach (function (i) {
            i.onclick = function () {
                const is = document.querySelector(".login-type__selector li.--focused");
                if (is) {
                    is.classList.remove("--focused")
                }
                const prt = i.parentNode;
                prt.classList.add("--focused");
            }
        });

    </script>


@endsection
