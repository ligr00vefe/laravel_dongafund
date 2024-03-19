@if ($paginator->hasPages())
    <div class="paging-wrap">
        <ul class="pager">

            @if ($paginator->onFirstPage())
                <li class="pg-arrow pg-prev">
                    <i class="fas fa-chevron-left"></i>
                </li>
            @else
                <li class="pg-arrow pg-prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $key => $element)

                {{-- 페이지가 중간일때 1,2 ... 페이지 안보이게 하기 --}}
                @if ($key == 0 && isset($elements[2]) && is_array($elements[2]) && $elements[3] == "...")
                    @continue
                @endif

                {{-- 마지막 페이지그룹일때 1, 2 ... 안보이게 하기 --}}
                @if ($key == 0 && !isset($elements[1]) && !isset($elements[2]) && isset($elements[3]) && $elements[3] == "..."  && $paginator->currentPage() > 10)
                    @continue
                @endif

                {{-- 페이지가 중간일때 ... 마지막-1, 마지막 페이지 안보이게 하기 --}}
                @if ($key == 4 && isset($elements[1]) && $elements[1] == "..." && $elements[3] == "..." )
                    @continue
                @endif

                {{-- 첫페이지 그룹일때 마지막페이지 안보이게 하기 --}}
                @if ($key == 4 && !isset($elements[1]) && !isset($elements[2]) && $elements[3] == "..."  && $paginator->currentPage() < 10)
                    @continue
                @endif



                @if (is_string($element))
{{--                    <li class="disabled"><span>{{ $element }}</span></li>--}}
                @endif


                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <li class="active my-active current-pg {{ $key }} {{ $key == 0 }}"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li class="pg-arrow pg-next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="pg-arrow pg-next">
                    <i class="fas fa-chevron-right"></i>
                </li>
            @endif
        </ul>
    </div>
@endif
