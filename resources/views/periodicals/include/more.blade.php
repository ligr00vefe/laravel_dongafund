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
                <button class="btn-download"><i class="fas fa-download"></i>다운로드</button>
            </div>{{-- .hidden-side end --}}
        </div>
    </li>
@endforeach
