<div class="support-posts-wrap">

    <ul id="list" class="dis-ib">
        @foreach ($lists as $list)
        <li>
            <div class="mouseover-event hidden">
                <div class="post-info">
                    @if ($list->icon)
                        <img src="{{ "storage/" . getAttachPath($list->icon) }}" alt="아이콘">
                    @else
                    <i class="fas fa-university"></i>
                    @endif
                    <h3>
                        {{ $list->subject }}
                    </h3>
                    <p>
                        {{ strip_tags($list->contents) }}
                    </p>
                    <div class="layout-center">
                        <a href="/donate?program={{ $list->id }}">
                            기부하기
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <div class="img-wrap"
                     style="background-image:url({{ $list->thumbnail ? "/storage/" . getAttachPath($list->thumbnail) : "/img/program_noimg.png" }})"
                >

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
    </ul>
</div>

<div class="more-wrapper">
    <button type="button" id="loadMore" data-page="1">
        더보기
        <i class="fa fa-chevron-down"></i>
    </button>

    <a href="#" class="bottom__link">
        <i class="fa fa-question-circle"></i>
        지원이 필요한 곳 살펴보기
    </a>
</div>
<script>


    function loadPostsEvent() {
        const posts = document.querySelectorAll(".support-wrap .support-posts-wrap ul li");

        return posts.forEach(function (i, v) {

            i.addEventListener("mouseover", function () {
                i.classList.add('on');
                fadeIn(i.querySelector(".mouseover-event"));
                fadeOut(i.querySelector(".content-wrapper"));
            });
            i.addEventListener("mouseleave", function () {
                i.classList.remove('on');
                fadeIn(i.querySelector(".content-wrapper"));
                fadeOut(i.querySelector(".mouseover-event"));
            });
        });
    }

    loadPostsEvent();

    document.getElementById("loadMore").onclick = function () {

        const _this = this;
        let page = Number(_this.dataset.page) + 1;

        axios.get("/async/support/more?category=campaign&page="+page)
            .then(function (response) {
                document.getElementById("list").innerHTML += response.data;
                _this.dataset.page = page;
                loadPostsEvent();
            })

    }


</script>
