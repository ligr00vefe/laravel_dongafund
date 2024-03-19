<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>동아대학교 발전기금 | @yield("title", "main")</title>
    <script src="/lib/jquery-3.5.1.min.js"></script>
    @stack("assets")
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/lounge.css">
    <link rel="stylesheet" href="/css/compile/fontawesome.css">
    @if (Browser::isIE())
        <script src="/js/polyfill.js"></script>
        <script src="/js/promise.polyfill.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.10.4/polyfill.min.js"></script>
    @endif
    <script src="/lib/axios.min.js"></script>
{{--    <script src="{{ asset('js/webpack.js') }}" defer></script>--}}

    @stack("scripts")
</head>
<body>

@include("_include.toast")
@include("_include.hamburger")

@if (session()->get("msg") != "")
    <script>
        alert('{{session()->get('msg')}}');
    </script>
@endif

@if (session()->get("error") != "")
    <script>
        alert('{{session()->get('error')}}');
    </script>
@endif

<div id="app">
    <nav id="nav">
        <div class="nav-in">
            <div class="logo-wrap">
                <a href="/">
                    <div class="logo-black large">
                        <img src="/img/logo_pc_tablet.png" alt="로고">
                        <span>동아대학교 발전기금</span>
                    </div>
                    <div class="logo-black medium">
                        <img src="/img/logo_mobile.png" alt="로고">
                        <span>동아대학교 발전기금</span>
                    </div>
                    <div class="logo-white large">
                        <img src="/img/logo_pc_tablet.png" alt="로고">
                        <span>동아대학교 발전기금</span>
                    </div>
                    <div class="logo-white medium">
                        <img src="/img/logo_mobile.png" alt="로고">
                        <span>동아대학교 발전기금</span>
                    </div>
{{--                    <img src="/img/logo_black.png" alt="" class="logo-black large">--}}
                </a>
            </div>
            <div class="center-menus">
                <ul class="menu dis-ib">
                    <li>
                        <a href="/donate?program=7">기부 프로그램</a>
                        <div class="sub-menus-wrap">
                            <div class="sub-menu__wrap">
                                <ul class="sub-menus dis-ib program-menu">
                                    <li>
                                        <a href="/donate?program=7">대학발전 전반 지원</a>
                                    </li>
                                    <li>
                                        <a href="/support?category=campaign">주요 캠페인 지원</a>
                                    </li>
                                    <li>
                                        <a href="/support?category=student">학생 지원</a>
                                    </li>
                                    <li>
                                        <a href="/support?category=research">연구 지원</a>
                                    </li>
                                    <li>
                                        <a href="/support?category=college">단과대/학과 지원</a>
                                    </li>
                                    <li>
                                        <a href="/support?category=life">대학생활 지원</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sub-menu-announce">
                                <i class="fa fa-gift"></i>
                                <span>기부자님께서는 관련법령에 따라 세제혜택을 받으실 수 있습니다.</span> <a href="/benefit">세제혜택 바로가기</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="/fund/type">기부유형</a>
                        <div class="sub-menus-wrap sub-menus-large">
                            <div class="sub-menu__wrap">
                                <table>
                                    <tr>
                                        <th>
                                            <p>일반기부</p>
                                        </th>
                                        <th>
                                            <p>간편기부</p>
                                        </th>
                                        <th>
                                            <p>현물기부</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/fund/type">
                                                전화
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                무통장입금
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                유가증권
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/fund/type">
                                                팩스
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                자동이체
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                물품/시설
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/fund/type">
                                                이메일
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                카카오페이
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                부동산
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/fund/type">
                                                우편
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                네이버페이
                                            </a>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/fund/type">
                                                직접방문
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                신용카드
                                            </a>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            <a href="/fund/type">
                                                BNK부산은행
                                            </a>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="sub-menu-announce">
                                <i class="fa fa-gift"></i>
                                <span>기부자님께서는 관련법령에 따라 세제혜택을 받으실 수 있습니다.</span> <a href="/benefit">세제혜택 바로가기</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="/news">기부자 라운지</a>
                        <div class="sub-menus-wrap sub-menus-large lounge">
                            <div class="sub-menu__wrap sub-menu__wrap-lounge">
                                <table>
                                    <tr>
                                        <td>
                                            <a href="/news">
                                                기부소식
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/fame">
                                                기부자 예우
                                            </a>
                                        </td>
{{--                                        <td>--}}
{{--                                            <a href="/history">--}}
{{--                                                기부내역 조회--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/status">
                                                모금현황
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/benefit">
                                                세제혜택
                                            </a>
                                        </td>
{{--                                        <td>--}}
{{--                                            <a href="/receipt">--}}
{{--                                                기부금 영수증--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/periodicals">
                                                정기간행물
                                            </a>
                                        </td>
                                        <td>
{{--                                            <a href="/fame">--}}
{{--                                                명예의 전당--}}
{{--                                            </a>--}}
                                        </td>
                                        <td>
                                            <a href="#">

                                            </a>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="sub-menu-announce">
                                <i class="fa fa-gift"></i>
                                <span>기부자님께서는 관련법령에 따라 세제혜택을 받으실 수 있습니다.</span> <a href="/benefit">세제혜택 바로가기</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="right-menus">
                <ul class="right-menus dis-ib">
                    <li class="swp-b-right-1 sw-md-hide"><a href="/partners">협정체결 기관</a></li>
                    <li class="sw-md-hide"><a href="/sponsors">후원의 집</a></li>
                    <li><a href="/fund/intro" class="btn-orange-gradient">기부하기</a></li>
                    <li class="sw-md-iblock">
                        <button id="hamburgerOpen" class="hamburger-menu" type="button">
                            <div></div>
                            <div></div>
                            <div></div>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="nav-mobile-menu">
            <ul class="dis-ib">
                <li>
                    <a href="/support?category=campaign">기부 프로그램</a>
                </li>
                <li>
                    <a href="/fund/type">기부유형</a>
                </li>
                <li>
                    <a href="/news">기부자 라운지</a>
                </li>
            </ul>
        </div>

    </nav>

    <main id="main">
        @yield("content")
    </main>

    <footer>
        <div class="footer-in">
            <div class="container">
                <div class="bank-info">
                    <table>
                        <tr>
                            <th>
                                <i class="fa fa-donate"></i>
                                계좌안내
                            </th>
                            <td>
                                <div class="bank-info__td-column">
                                    <img src="/img/icon_bnkbank.svg" alt="부산은행">
                                    <span>029-01-027228-1</span>
                                </div>
                                <div class="bank-info__td-column column-large">
                                    <img src="/img/icon_nhbank.svg" alt="NH농협은행">
                                    <span>944-17-044326</span>
                                </div>
                            </td>
                            <th class="bank-info__td-small-auth">
                                <i class="fa fa-phone-alt"></i>
                                기부문의
                            </th>
                            <td class="bank-info__tel-number">
                                <i class="fa fa-phone-alt"></i> 051-200-6012
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div id="bottomNavigation" class="container dis-flex-bet">
                <div>
                    <table class="links">
                        <tr>
                            <th>바로가기</th>
                            <td>
                                <ul class="dis-ib rotate-15">
                                    <li>
                                        <a href="javascript:void(0)">약정서 다운로드 <i class="fa fa-file-download"></i></a>
                                    </li>
{{--                                    <li>--}}
{{--                                        <a href="javascript:void(0)">모금아이디어 제안</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="/mail/number">내 주소 변경하기</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:void(0)">담당자 안내</a>--}}
{{--                                    </li>--}}
                                    <li class="none">
                                        <a href="https://donga.ac.kr/gzSub_014.aspx"
                                           class="bottom__link--point-blue"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                        >개인정보처리방침</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>웹사이트</th>
                            <td>
                                <ul class="dis-ib rotate-15">
                                    <li><a href="https://donga.ac.kr" target="_blank" rel="noopener noreferrer">
                                            동아대학교
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://damc.or.kr" rel="noopener noreferrer">
                                            동아대학교병원
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.daudh.or.kr" rel="noopener noreferrer">
                                            동아대학교대신요양병원
                                        </a>
                                    </li>
                                    <li class="none">
                                        <a href="http://dongmun.donga.ac.kr/" rel="noopener noreferrer">
                                            동아대학교총동문회
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="footer-logo-wrap">
                    <img src="/img/logo_footer.png" alt="로고">
                </div>
            </div>

            <div class="m-top-40"></div>

            <div class="univ-intro-wrap container">
                <div class="info-bar__wrapper">
                    <table class="footer-info-table">
                        <tr>
                            <th>
                                상호명
                            </th>
                            <td class="footer-info__table--size-bigger">
                                동아대학교
                            </td>
                            <th>
                                총장
                            </th>
                            <td class="footer-info__table--size-bigger">
                                이 해 우
                            </td>
                            <th>
                                대학본부
                            </th>
                            <td class="footer-info__table--size-bigger">
                                부산광역시 사하구 낙동대로 550번길 37<span class="dis-none-small">(하단동)</span>
                            </td>
                        </tr>
                    </table>
                    <table class="footer-info-table">
                        <tr>
                            <th>
                                사업자등록번호
                            </th>
                            <td class="footer-info__table--size-bigger">
                                603-82-01274
                            </td>
                            <th>
                                대표 전화번호
                            </th>
                            <td class="footer-info__table--size-bigger">
                                051-200-6012
                            </td>
                            <th></th>
                            <td></td>
                        </tr>
                    </table>
                    <p>동아대학교는 법인세법 제24조, 동법시행령 제38조에 따른 법정기부금 단체입니다.</p>
                </div>

                <div class="sns-wrapper">
                    <div>
                        <a href="http://pf.kakao.com/_PNbKs" target="_blank" rel="noreferrer noopener">
                            <svg style="fill: #555555; width:19px; position: relative; top: 3px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 208 191.94"><g><polygon class="cls-1" points="76.01 89.49 87.99 89.49 87.99 89.49 82 72.47 76.01 89.49"/><path class="cls-1" d="M104,0C46.56,0,0,36.71,0,82c0,29.28,19.47,55,48.75,69.48-1.59,5.49-10.24,35.34-10.58,37.69,0,0-.21,1.76.93,2.43a3.14,3.14,0,0,0,2.48.15c3.28-.46,38-24.81,44-29A131.56,131.56,0,0,0,104,164c57.44,0,104-36.71,104-82S161.44,0,104,0ZM52.53,69.27c-.13,11.6.1,23.8-.09,35.22-.06,3.65-2.16,4.74-5,5.78a1.88,1.88,0,0,1-1,.07c-3.25-.64-5.84-1.8-5.92-5.84-.23-11.41.07-23.63-.09-35.23-2.75-.11-6.67.11-9.22,0-3.54-.23-6-2.48-5.85-5.83s1.94-5.76,5.91-5.82c9.38-.14,21-.14,30.38,0,4,.06,5.78,2.48,5.9,5.82s-2.3,5.6-5.83,5.83C59.2,69.38,55.29,69.16,52.53,69.27Zm50.4,40.45a9.24,9.24,0,0,1-3.82.83c-2.5,0-4.41-1-5-2.65l-3-7.78H72.85l-3,7.78c-.58,1.63-2.49,2.65-5,2.65a9.16,9.16,0,0,1-3.81-.83c-1.66-.76-3.25-2.86-1.43-8.52L74,63.42a9,9,0,0,1,8-5.92,9.07,9.07,0,0,1,8,5.93l14.34,37.76C106.17,106.86,104.58,109,102.93,109.72Zm30.32,0H114a5.64,5.64,0,0,1-5.75-5.5V63.5a6.13,6.13,0,0,1,12.25,0V98.75h12.75a5.51,5.51,0,1,1,0,11Zm47-4.52A6,6,0,0,1,169.49,108L155.42,89.37l-2.08,2.08v13.09a6,6,0,0,1-12,0v-41a6,6,0,0,1,12,0V76.4l16.74-16.74a4.64,4.64,0,0,1,3.33-1.34,6.08,6.08,0,0,1,5.9,5.58A4.7,4.7,0,0,1,178,67.55L164.3,81.22l14.77,19.57A6,6,0,0,1,180.22,105.23Z"/></g></svg>
                        </a>
                    </div>
                    <div>
                        <a href="mailto:fund@donga.ac.kr" target="_blank" rel="noreferrer noopener">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </div>
                    <div>
                        <a href="https://www.youtube.com/channel/UCYXWpF0ptQvQYSZlo41CPmg" target="_blank" rel="noreferrer noopener">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div>
                        <a href="https://www.instagram.com/donga_univ/" target="_blank" rel="noreferrer noopener">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-logo--visible-medium">
                    <img src="/img/logo_footer.png" alt="로고">
                </div>

            </div>

        </div>
    </footer>

    <script src="/js/app.js"></script>
    <!-- Channel Plugin Scripts -->
    <script>
        (function() {
            var w = window;
            if (w.ChannelIO) {
                return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
            }
            var ch = function() {
                ch.c(arguments);
            };
            ch.q = [];
            ch.c = function(args) {
                ch.q.push(args);
            };
            w.ChannelIO = ch;
            function l() {
                if (w.ChannelIOInitialized) {
                    return;
                }
                w.ChannelIOInitialized = true;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
                s.charset = 'UTF-8';
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }
            if (document.readyState === 'complete') {
                l();
            } else if (window.attachEvent) {
                window.attachEvent('onload', l);
            } else {
                window.addEventListener('DOMContentLoaded', l, false);
                window.addEventListener('load', l, false);
            }
        })();
        ChannelIO('boot', {
            "pluginKey": "ca0897a8-9aaf-4f95-bd11-7e46fdf8b93c"
        });
    </script>
    <!-- End Channel Plugin -->
</div>
</body>
</html>
