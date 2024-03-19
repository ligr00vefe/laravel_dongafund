<div class="news-posts__wrap">
    <div id="mainNews" class="news-major-post" data-id="{{ $lists[0]->id }}">
        <a href="{{ isset($lists[0]->id) ? "/news/{$lists[0]->id}" : "" }}">
            <h1 class="major-post__title">{{strip_tags($lists[0]->title)}}</h1>
            <div class="mj-con mj-con__left">
                <img src="{{ getAttachPath($lists[0]->thumbnail) ? '/storage/'.getAttachPath($lists[0]->thumbnail) : '/img/program_noimg.png' }}" alt="기부뉴스 메인 이미지"/>
            </div>
            <div class="mj-con mj-con__right">
                <h2 class="mj-con__subTitle">{{ isset($lists[0]->subtitle) ? strip_tags_blink_removing($lists[0]->subtitle) : "" }}</h2>
                <p class="mj-con__content">
                    {{ isset($lists[0]->contents) ? strip_tags_blink_removing($lists[0]->contents) : "" }}
                </p>
                <p class="mj-con__hashTag">
                    <a href="/news?category={{$lists[0]->category}}">
                        #{{ $lists[0]->category ?? "" }}
                    </a>
                </p>
            </div>
        </a>
    </div>{{-- .news-major-post end --}}

    <ul class="news-list dis-ib list" id="lists">
        @foreach ($lists as $key => $list)
            @if($key > 0)
                <li>
                    <a href=" {{ "/news/{$list->id}" }}">
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
                                {{strip_tags_blink_removing($list->title)}}
                            </p>
                            <p class="news-content">
                                {{strip_tags_blink_removing($list->subtitle)}}
                            </p>
                        </div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

    <div class="btn-more__wrap">
        <button id="loadMore" data-page="{{$lists->currentPage()}}" class="btn-more">더보기 <i class="fas fa-chevron-down"></i></button>
        <span class="more-shortcut"><i class="fas fa-question-circle"></i>지원이 필요한 곳 살펴보기</span>
    </div>

</div>{{-- .news-posts-wrap end --}}

<script>
    window.onload = function() {

        document.getElementById("loadMore").onclick = function () {

            const _this = this;
            let page = Number(_this.dataset.page) + 1;
            let getCategory = "{{ $category ?? "" }}"
            const mainNewsId = document.getElementById("mainNews").dataset.id;

            axios.get("/async/news/more?page=" + page + "&async=true&category=" + getCategory + "&notIn=" + mainNewsId)
                .then(function (response) {
                    _this.dataset.page = page;
                    if (response.data != "") {
                        document.getElementById("lists").innerHTML += response.data;
                    } else {
                        document.getElementById("loadMore").style.display = "none";
                    }
                })
        }
    }

</script>
