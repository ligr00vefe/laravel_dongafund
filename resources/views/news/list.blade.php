<div class="news-posts__wrap">
    <div class="news-major-post">
        <h1 class="major-post__title">{{strip_tags($lists[0]->title)}}</h1>
        <div class="mj-con mj-con__left">
            <img src="{{ getAttachPath($lists[0]->thumbnail) ? '/storage/'.getAttachPath($lists[0]->thumbnail) : '/img/program_noimg.png' }}" alt="기부뉴스 메인 이미지"/>
        </div>
        <div class="mj-con mj-con__right">
            <h2 class="mj-con__subTitle">{{strip_tags($lists[0]->subtitle)}}</h2>
            <p class="mj-con__content">
                {{strip_tags(strip_tags($lists[0]->contents))}}
            </p>
            <p class="mj-con__hashTag">
                <a href="/news?category={{$lists[0]->category}}">
                    #{{$lists[0]->category}}
                </a>
            </p>
        </div>
    </div>{{-- .news-major-post end --}}

    <ul class="news-list dis-ib list" id="list">
        @foreach ($lists as $key => $list)
            @if($key > 0)
                <li>
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
                            {{strip_tags($list->title)}}
                        </p>
                        <p class="news-content">
                            {{strip_tags($list->subtitle)}}
                        </p>
                    </div>
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

            let page = Number(this.dataset.page) + 1;

            let pageResult = {};

            let getCategory = "{{ $category ?? "" }}"

            axios.get("/async/news/more?page=" + page + "&async=true&category=" + getCategory)
                .then(function (response) {
                    pageResult = response.data.data;
                })

            let text = "";
            for (let value of pageResult) {
                let category = value.category;
                let title = value.title;
                let subTitle = value.subtitle;
                let path = value.path;

                text += "<li>";
                text += "<div class='img-wrap'>";
                text += "<img src=storage/" + path + " alt='이미지'>";
                text += "</div>";
                text += "<div class='text-wrap'>";
                text += "<h3 class='news-cate'>";
                text += "<a href=/news?category=" + category + ">";
                text += category;
                text += "</a>";
                text += "</h3>";
                text += "<p class=news-title>";
                text += title;
                text += "</p>";
                text += "<p class=news-content>";
                text += subTitle;
                text += "</p>";
                text += "</div>";
                text += "</li>";
            }
            document.getElementById("list").innerHTML += text;
        }
    }

</script>
