<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>동아대학교 발전기금 | 관리자 | @yield("title", "main")</title>
    <script src="/lib/jquery-3.5.1.min.js"></script>
    @stack("assets")
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/lounge.css">
    <link rel="stylesheet" href="/css/compile/fontawesome.css">
    <script src="/js/polyfill.js"></script>
    <script src="/lib/axios.min.js"></script>
    @stack("scripts")
</head>
<body>

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
        <div class="admin-logo">
            <img class="logo-img" src="/img/admin_logo_img_w.png">
            <span>동아대학교 발전기금</span>
        </div>
        <ul class="menu-1dp">
            <li><span><i class="fas fa-tachometer-alt"></i>대시보드</span></li>
            <li>
                <span><i class="fas fa-donate"></i>기부금 관리</span>
                <ol class="menu-2dp">
                    <li><a href="/{{ $adminUrlPrefix }}/donate/contract">약정관리</a></li>
                    <li><a href="/{{ $adminUrlPrefix }}/donate/payment">결제/승인 내역</a></li>
                    <li><a href="javascript:void(0)">납입 관리</a></li>
                    <li><a href="javascript:void(0)">기부금영수증 발급 내역</a></li>
                    <li><a href="javascript:void(0)">발전기금 시스템 조회</a></li>
                </ol>
            </li>
            <li class="{{ focused($admSideMenu ?? "", "program") }}">
                <a href="/b1BjW55p/donate/program">
                    <i class="fas fa-book"></i>
                    기부금 프로그램 관리
                </a>
            </li>
            <li>
                <span><i class="fas fa-users"></i>예우대상자 풀</span>
                <ol class="menu-2dp">
                    <li><a href="javascript:void(0)">예우대상자 관리</a></li>
                    <li><a href="javascript:void(0)">우편발송 관리</a></li>
                </ol>
            </li>
            <li>
                <span><i class="fas fa-desktop"></i>전자모금함 관리</span>
                <ol class="menu-2dp">
                    <li><a href="javascript:void(0)">기기 설정</a></li>
                    <li><a href="javascript:void(0)">모금현황</a></li>
                </ol>
            </li>
            <li>
                <span><i class="fas fa-newspaper"></i>컨텐츠 관리</span>
                <ol class="menu-2dp">
                    <li class="{{ focused($admSideMenu ?? "", "news") }}">
                        <a href="/b1BjW55p/contents/news">기부소식</a>
                    </li>
                    <li class="{{ focused($admSideMenu ?? "", "periodicals") }}">
                        <a href="/b1BjW55p/contents/periodicals">간행물</a>
                    </li>
                    <li class="{{ focused($admSideMenu ?? "", "contract") }}">
                        <a href="/b1BjW55p/contents/contract">협약서</a>
                    </li>
                    <li><a href="javascript:void(0)">후원의 집</a></li>
                </ol>
            </li>

            <li class="{{ focused($admSideMenu ?? "", "auth") }}">
                <a href="/b1BjW55p/auth">
                    <i class="fas fa-user-cog"></i>
                    관리자권한
                </a>
            </li>

            <li>
                <span><i class="fas fa-user-shield"></i>개인정보관리</span>
                <ol class="menu-2dp">
                    <li class="{{ focused($admSideMenu ?? "", "agreement") }}">
                        <a href="/b1BjW55p/privacy/agreement">
                            개인정보 동의 내역
                        </a>
                    </li>
                    <li class="{{ focused($admSideMenu ?? "", "inquire") }}">
                        <a href="/b1BjW55p/privacy/inquire">
                            개인정보 조회 내역
                        </a>
                    </li>
                </ol>
            </li>
        </ul>
    </nav>

    <main id="main">
        <header>

            <h1>
                @yield("title")
            </h1>

            <div>
                <a href="#" class="header-menu">
                    <i class="fa fa-user"></i>
                    {{ \Illuminate\Support\Facades\Auth::user()->account_id }}
                </a>
                <a href="/auth/logout" class="header-menu">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>로그아웃</span>
                </a>
            </div>
        </header>

        @yield("content")
    </main>

    <script src="/js/admin.js"></script>
    <script>
        $(document).ready(function() {
            var currentIndex = 15;
            var thisIndex = 10;
            var menuOpened2dp = $('.menu-2dp li').hasClass('focused');
            var focusedObject2dp = $('.menu-2dp').find('.focus');

            if(menuOpened2dp) {
                focusedObject2dp.parent('ol').addClass('open');
            }

            $('.menu-1dp li').on('click', function () {
                var hasChild2dp = $(this).find('.menu-2dp');
                thisIndex = $(this).index();
                console.log('이전인덱스값: ', currentIndex);
                console.log('현재인덱스값: ', thisIndex);
                // console.log('삭제될인덱스값: ', prevIndex);
                if (hasChild2dp) {
                    if (currentIndex != thisIndex) {
                        $('.menu-1dp > li').eq(currentIndex).find('.menu-2dp').removeClass('open');

                        $(this).find('.menu-2dp').addClass('open');
                        currentIndex = thisIndex;
                    }
                }
            });
        });
    </script>
</div>
</body>
</html>
