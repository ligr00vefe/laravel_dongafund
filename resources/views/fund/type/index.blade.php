@extends("layouts/layout")

@section("title")
    기부유형
@endsection

@push("scripts")
    <link rel="stylesheet" href="/css/lounge.css">
    <link rel="stylesheet" href="/css/fund.css">
@endpush

@section("content")
    <div class="m-top-100"></div>

    <div class="container">
        <div class="sub-page__wrap">
            <div class="page-header dis-flex-bet">
                <div>
                    <h1>기부유형</h1>
                    <span>지역을 품고 세계와 함께하는 명문 사학,동아대학교<span class="visible__fhd">, 동아대학교</span></span>
                </div>
                <div class="page-header__search">
                    <form action="">
                        <input type="text" name="term" class="input-search" placeholder="검색어를 입력해주세요">
                        <button class="btn-search">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>{{-- .page-header end --}}

            <div class="container__inner--type swp-row-100-white ff-paybookbold">
                <div class="fund__type--header">
                    <ul>
                        <li>
                            <a href="#" data-type="1">
                                <i class="fas fa-donate"></i>
                                <p>일반기부</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-type="2">
                                <i class="fas fa-credit-card"></i>
                                <p class="">간편기부</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-type="3">
                                <i class="fas fa-box-open"></i>
                                <p>현물기부</p>
                            </a>
                        </li>
                    </ul>
                </div>



                <div class="fund__type--body">
                    <div class="type--body-title" id="fundType1">
                        <span>일반기부</span>
                    </div>
                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">전화</div>
                            <div class="right-content">
                                <p>동아대학교로 직접 전화주셔서 기부하실 수 있습니다.</p>
                                <p>기부자님께서 희망하시는 방식으로 기부가 이루어지도록 친절히 안내 드리겠습니다.</p>
                            </div>
                            <div class="right-tel">
                                <i class="fas fa-phone"></i>
                                051-200-6012 (동아대학교 대외협력처)
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content1-rigiht">

                            <div class="right-title">서면 (카카오톡/이메일/팩스/우편)</div>
                            <div class="right-content">
                                <p>동아대학교에 약정서를 보내주셔서 기부하실 수 있습니다.</p>
                                <p>약정서를 다운로드 후 카카오톡/이메일/팩스/우편 중 편하신 방법으로 보내주시면 담당자가 수령 후 상세히 안내 드리겠습니다. 원본, 스캔본, 사진촬영본
                                    모두 가능합니다.</p>
                            </div>

                            <div class="right-sub">
                                <div class="sub1">
                                    <svg style="fill: #555555; width:20px; position: relative; top: 3px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 208 191.94"><g><polygon class="cls-1" points="76.01 89.49 87.99 89.49 87.99 89.49 82 72.47 76.01 89.49"/><path class="cls-1" d="M104,0C46.56,0,0,36.71,0,82c0,29.28,19.47,55,48.75,69.48-1.59,5.49-10.24,35.34-10.58,37.69,0,0-.21,1.76.93,2.43a3.14,3.14,0,0,0,2.48.15c3.28-.46,38-24.81,44-29A131.56,131.56,0,0,0,104,164c57.44,0,104-36.71,104-82S161.44,0,104,0ZM52.53,69.27c-.13,11.6.1,23.8-.09,35.22-.06,3.65-2.16,4.74-5,5.78a1.88,1.88,0,0,1-1,.07c-3.25-.64-5.84-1.8-5.92-5.84-.23-11.41.07-23.63-.09-35.23-2.75-.11-6.67.11-9.22,0-3.54-.23-6-2.48-5.85-5.83s1.94-5.76,5.91-5.82c9.38-.14,21-.14,30.38,0,4,.06,5.78,2.48,5.9,5.82s-2.3,5.6-5.83,5.83C59.2,69.38,55.29,69.16,52.53,69.27Zm50.4,40.45a9.24,9.24,0,0,1-3.82.83c-2.5,0-4.41-1-5-2.65l-3-7.78H72.85l-3,7.78c-.58,1.63-2.49,2.65-5,2.65a9.16,9.16,0,0,1-3.81-.83c-1.66-.76-3.25-2.86-1.43-8.52L74,63.42a9,9,0,0,1,8-5.92,9.07,9.07,0,0,1,8,5.93l14.34,37.76C106.17,106.86,104.58,109,102.93,109.72Zm30.32,0H114a5.64,5.64,0,0,1-5.75-5.5V63.5a6.13,6.13,0,0,1,12.25,0V98.75h12.75a5.51,5.51,0,1,1,0,11Zm47-4.52A6,6,0,0,1,169.49,108L155.42,89.37l-2.08,2.08v13.09a6,6,0,0,1-12,0v-41a6,6,0,0,1,12,0V76.4l16.74-16.74a4.64,4.64,0,0,1,3.33-1.34,6.08,6.08,0,0,1,5.9,5.58A4.7,4.7,0,0,1,178,67.55L164.3,81.22l14.77,19.57A6,6,0,0,1,180.22,105.23Z"/></g></svg>
                                    dongafund
                                </div>
                                <div class="sub2">
                                    <i class="fas fa-fax"></i>
                                    051-200-6015
                                </div>
                            </div>

                            <div class="right-sub">
                                <div class="sub1">
                                    <i class="fas fa-envelope"></i>
                                    fund@donga.ac.kr
                                </div>
                                <div class="sub2">
                                    <i class="fas fa-shipping-fast"></i>
                                    부산광역시 사하구 낙동대로 550번길 37 동아대학교 대외협력과
                                </div>
                            </div>

                            <div class="issued-box">
                                <ul class="issued-box__list">
                                    <li>
                                        <button type="button" class="issued-box__button basic">
                                            약정서 다운로드
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-walking"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">직접방문</div>
                            <div class="right-content">
                                <p>동아대학교에 직접 방문하셔서 기부하실 수 있습니다.</p>
                                <p>기부자님께서 희망하시는 방식으로 기부가 이루어지도록 친절히 안내 드리겠습니다.</p>
                            </div>
                            <div class="right-tel">
                                <i class="fas fa-map-marked-alt"></i>
                                부산 사하구 낙동대로 550번길 37 동아대학교 대학본부 S01-0313 대외협력과
                            </div>
                        </div>
                    </div>

                    <div class="type--body-title" id="fundType2">
                        <span>간편기부</span>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">자동이체</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
                                    <p>매월 지정하신 일자에 기부자님의 계좌에서 동아대학교로 자동이체 됩니다.</p>
                                    <p>(자동이체는 금융결제원을 통해 진행됩니다.)</p>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <img class="kakao_pay_img" src="../img/kakao_pay_img.png" alt="">
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">카카오페이</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
                                    <p>카카오페이를 통해 간편하게 기부하실 수 있습니다.</p>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <img class="n_pay_img" src="../img/n_pay_img.png" alt="">
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">네이버페이</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
{{--                                    <p>매월 지정하신 일자에 기부자님의 계좌에서 동아대학교로 자동이체 됩니다.</p>--}}
{{--                                    <p>(자동이체는 금융결제원을 통해 진행됩니다.)</p>--}}
                                    <p>
                                        네이버페이를 통해 간편하게 기부하실 수 있습니다.
                                    </p>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">신용카드</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
                                    <p>보유하고 계신 신용카드/체크카드로 기부하실 수 있습니다.</p>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">무통장입금</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
                                    <p>홈페이지에서 약정서를 작성하신 후 지정된 계좌로 입금해 주시면 기부가 완료 됩니다.</p>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <img class="busan_bank_logo_img" src="../img/busan_bank_logo.svg" alt="부산은행로고">
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">BNK부산은행 인터넷/모바일뱅킹</div>
                            <div class="right-content flex">
                                <div class="right-content-left">
                                    <p>부산은행 인터넷뱅킹/모바일뱅킹에서도 동아대학교에 기부하실 수 있습니다.</p>

                                    <P><i class="fas fa-desktop"></i> 부산은행 인터넷뱅킹 <i class="fas fa-chevron-right"></i>
                                    </P>
                                    <P><i class="fas fa-mobile-alt"></i> 부산은행 모바일뱅킹 &nbsp;<i class="fas fa-chevron-right"></i>
                                    </P>
                                    <P>
                                        <i class="fas fa-info"></i> <span>기부방법</span>
                                        로그인 <i class="fas fa-arrow-right"></i>
                                        이체 <i class="fas fa-arrow-right"></i>
                                        기부서비스 <i class="fas fa-arrow-right"></i>
                                        동아대학교
                                    </P>
                                </div>
                                <div class="right-content-right">
                                    <button class="btn-border-orange">기부하기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-title" id="fundType3">
                        <span>현물기부</span>
                    </div>
                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">유가증권</div>
                            <div class="right-content">
                                <p>보유하고 계신 상장/비상장 주식,채권 등 유가증권을 기부하실 수 있습니다.</p>
                                <p>동아대학교로 연락주시면 상세히 안내 드르겠습니다.</p>
                            </div>
                            <div class="right-tel">
                                <i class="fas fa-phone"></i>
                                051-200-6012 (동아대학교 대외협력처)
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-dolly"></i>
                        </div>
                        <div class="content1-rigiht">

                            <div class="right-title">물품/시설</div>
                            <div class="right-content">
                                <p>물품을 기증 하시거나 교육시설 리모델링 등을 통해 동아대학교를 지원하실 수 있습니다.</p>
                                <p>아래 전화번호로 연락주시면 상세히 안내 드리겠습니다.</p>
                            </div>

                            <div class="right-tel">
                                <i class="fas fa-phone"></i>
                                051-200-6012 (동아대학교 대외협력처)
                            </div>

                            <div class="issued-box">
                                <ul class="issued-box__list">
                                    <li>
                                        <button type="button" class="issued-box__button basic">
                                            현물기부 약정서
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="type--body-content1">
                        <div class="content1-left">
                            <i class="fas fa-map-marked"></i>
                        </div>
                        <div class="content1-rigiht">
                            <div class="right-title">부동산</div>
                            <div class="right-content">
                                <p>보유하고 계신 부동산(토지/건물 등)을 기부하실 수 있습니다.</p>
                                <p>동아대학교로 연락주시면 상세히 안내 드리겠습니다.</p>
                            </div>
                            <div class="right-tel">
                                <i class="fas fa-phone"></i>
                                051-200-6012 (동아대학교 대외협력처)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-footer">
                @include ("_include.donate")
            </div>
        </div>

        <script>
            const fundTypeAnchor = document.querySelectorAll(".fund__type--header li a");

            fundTypeAnchor.forEach (function (i) {

                i.onclick = function (e) {
                    e.preventDefault();
                    let _type = i.dataset.type;
                    let _target = document.getElementById("fundType" + _type);

                    smoothScrolling(_target)
                }

            })
        </script>


@endsection
