<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>동아대학교 발전기금 | @yield("title", "main")</title>
    <script src="/lib/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/lounge.css">
    <link rel="stylesheet" href="/css/compile/fontawesome.css">
    <script src="/js/polyfill.js"></script>
    @stack("scripts")
</head>
<body>




<div id="app" >


    <main id="main" class="m-bottom-40 partner-main">
        @yield("content")
    </main>



    <script src="/js/app.js"></script>
</div>
</body>
</html>
