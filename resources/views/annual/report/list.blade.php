<div class="report-posts__wrap">

    <ul class="report-list dis-ib">

        @if(count($lists) > 0)
            @foreach ($lists as $list)
                <li>
                    <div class="img-wrap">
                        <img src="/storage/{{ getAttachPath($list->thumbnail) }}" alt="이미지">
                    </div>
                    <div class="text-wrap">
                        <div class="front-side">
                            <h3 class="report-cate">
                                #{{$list->category}}
                            </h3>
                            <p class="report-title">
                                {{$list->title}}
                            </p>
                        </div>{{-- .front-side end --}}
                        <div class="hidden-side">
                            <button class="btn-download"><i class="fas fa-download"></i>다운로드</button>
                        </div>{{-- .hidden-side end --}}
                    </div>
                </li>
            @endforeach

            <div class="btn-more__wrap">
                <button class="btn-more">더보기 <i class="fas fa-chevron-down"></i></button>
            </div>

        @else
            <li class="empty_li">
                <div class="empty_div">
                    게시물이 없습니다.
                </div>
            </li>
        @endif
    </ul>

</div>{{-- .report-posts-wrap end --}}
<script>
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