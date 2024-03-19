@extends("layouts.layout")

@section("title")
    정기간행물
@endsection

@push("scripts")

@endpush

@section("content")

    <div class="m-top-100"></div>

    <div id="report-container" class="container">

        <div class="sub-page__wrap">

            {{-- 기부자라운지 헤더
                  //.page-contents 시작태그 포함 --}}
            @include ("_include.lounge_head")

                <div class="contents-body">
                    @include ("periodicals.include.list")
                </div>

            </div>{{-- .page-contents end --}}

        </div>{{-- .sub-page-wrap end --}}

        <div class="page-footer">
            @include ("_include.donate")
        </div>

    </div>{{-- .container end --}}

    <script>

        function more(_this)
        {
            const page = Number(_this.dataset.page) + 1;
            axios.get("/async/periodicals/more?page=" + page)
                .then(function (response) {
                    _this.dataset.page = page;
                    if (response.data != "") {
                        document.getElementById("lists").innerHTML = document.getElementById("lists").innerHTML + response.data;
                    } else {
                        document.querySelector(".btn-more").style.display = "none";
                    }
                })
        }



        $(document).ready(function(){
            var winWidth = $(window).width();
            var currentListIndex = 100;
            var thisListIndex = 100;

            if(winWidth > 1201) {
                $('.report-list li').mouseenter(function(){
                    $(this).addClass('on');
                });
                $('.report-list li').mouseleave(function(){
                    $(this).removeClass('on');
                });
            }
            if(winWidth < 1200) {
                $('.report-list li').click(function(){
                    thisListIndex = $(this).index();
                    // console.log('currentListIndex: ', currentListIndex);
                    // console.log('thisListIndex: ', thisListIndex);

                    if(currentListIndex == thisListIndex) {
                        $(this).removeClass('on');
                    }else {
                        $('.report-list li').removeClass('on');
                        $(this).addClass('on');
                        // currentListIndex = $(this).index();
                    }
                });
            }
        });
    </script>

@endsection
