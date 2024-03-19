@extends("layouts/layout")

@section("title")
    개인정보변경
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="auth-change">

        <div class="auth-change-container">

            <div class="auth-change-contents">

                <div class="auth-change-contents__title">
                    <p>
                        <i class="fa fa-user-edit"></i>
                        <span class="dot-sky-bottom"></span>
                        개인정보 변경
                    </p>
                </div>

                <div class="auth-change-contents__body">

                    <ul class="auth-change__half-divider">
                        <li>
                            <div class="swp-input-wrap swp-input-wrap--type-lock">
                                <span class="isValue">성명</span>
                                <div class="row">
                                    <input type="text" name="number" id="number" placeholder="" value="김동아" readonly disabled>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="swp-input-wrap">
                                <span>전화번호</span>
                                <div class="row">
                                    <input type="text" name="number" id="number" placeholder="" value="">
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="auth-change__input-wrapper">
                        <div class="swp-input-wrap swp-input-wrap--type-lock">
                            <span class="isValue">주민등록번호</span>
                            <div class="row">
                                <input type="text" name="number" id="number" placeholder="" value="910101-1234567" readonly disabled>
                            </div>
                        </div>
                    </div>

                    <ul class="auth-change__half-divider auth-change__input-wrapper">
                        <li class="half-cell--size-small">
                            <div class="swp-input-wrap">
                                <span class="isValue">우편번호</span>
                                <div class="row">
                                    <input type="text" name="" id="" placeholder="" value="12346">
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="auth-change__input-wrapper">
                        <div class="swp-input-wrap">
                            <span class="isValue">주소</span>
                            <div class="row">
                                <input type="text" class="input--large" name="" id="" placeholder="" value="부산광역시 사하구 낙동대로 550번길 37(하단동)" >
                            </div>
                        </div>
                    </div>

                    <div class="auth-change__input-wrapper">
                        <div class="swp-input-wrap">
                            <span class="isValue">상세주소</span>
                            <div class="row">
                                <input type="text" class="input--large" name="" id="" placeholder="" value="S01-0313 대외협력과">
                            </div>
                        </div>
                    </div>

                    <ul class="auth-change__half-divider auth-change__input-wrapper">
                        <li class="select-wrap select-wrap--type-small">
                            <select name="" id="" class="arrow-hide selected-gray--not-null">
                                <option value="">학교와의 관계</option>
                            </select>
                            <i class="fa fa-chevron-down"></i>
                        </li>
                        <li class="select-wrap ">
                            <select name="" id="" class="arrow-hide selected-gray--not-null">
                                <option value="">입학연도</option>
                            </select>
                            <i class="fa fa-chevron-down"></i>
                        </li>
                    </ul>

                    <div class="auth-change__input-wrapper">
                        <div class="swp-input-wrap">
                            <span>학과/이수과정</span>
                            <div class="row">
                                <input type="text" class="input--large" name="" id="" placeholder="">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="auth-change-bottom">

                <button>
                    <i class="fa fa-check"></i>
                    확인
                </button>

            </div>

        </div>

    </div>



@endsection
