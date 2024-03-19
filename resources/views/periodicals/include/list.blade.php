<div class="report-posts__wrap">

    <ul id="lists" class="report-list dis-ib">


        @if(count($lists) > 0)
            @foreach ($lists as $list)
                <li>
                    <div class="img-wrap">
                        <img src="/storage/{{getAttachPath($list->thumbnail)}}" alt="이미지">
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
                            <a href="/storage/{{ getAttachPath($list->attachment1) }}" target="_blank" class="btn-download"><i class="fas fa-download"></i>다운로드</a>
                        </div>{{-- .hidden-side end --}}
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="btn-more__wrap">
            <button class="btn-more" data-page="1" onclick="more(this)">더보기 <i class="fas fa-chevron-down"></i></button>
        </div>
        @else
            <li class="empty_li">
                <div class="empty_div">
                    게시물이 없습니다.
                </div>
            </li>
        </ul>
        @endif


</div>{{-- .report-posts-wrap end --}}

