@foreach ($lists as $key => $list)
    <li>
        <a href="{{ "/news/{$list->id}" }}">
            <div class="img-wrap">
                <img src="{{getAttachPath($list->thumbnail) ? 'storage/'.getAttachPath($list->thumbnail) : '/img/program_noimg.png'}}" alt="이미지">
            </div>
            <div class="text-wrap">
                <h3 class="news-cate">
                    <a href="/news?category={{$list->category}}">
                        #{{$list->category}}
                    </a>
                </h3>
                <p class="news-title">
                    {{$list->title}}
                </p>
                <p class="news-content">
                    {{$list->subtitle}}
                </p>
            </div>
        </a>
    </li>
@endforeach
