@foreach ($lists as $list)
    <li>
        <div class="mouseover-event hidden">
            <div class="post-info">
                <i class="fas fa-university"></i>
                <h3>
                    {{ $list->subject }}
                </h3>
                <p>
                    {!! $list->contents !!}
                </p>
                <div class="layout-center">
                    <a href="/donate?program={{ $list->id }}">
                        기부하기
                    </a>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="img-wrap">
                <img src="{{ $list->thumbnail ? "/storage/" . getAttachPath($list->thumbnail) : "/img/program_noimg.png" }}" alt="썸네일이미지">
            </div>
            <div class="text-wrap">
                <h3 class="">
                    {{ $list->subject }}
                </h3>
                <p>
                    @if ($list->fixing_check == 1)
                        <i class="fas fa-donate"></i>
                        <span>누적모금액 {{ number_format($list->fixing_price) }} 원</span>
                    @endif
                </p>
            </div>
        </div>
    </li>
@endforeach
