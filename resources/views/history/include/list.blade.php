<div class="history-posts__wrap">
    <ul class="history-list dis-ib">
        @forelse ($lists as $list)
            @includeWhen($list->donation_type == "일시기부", "history.include.once")
            @includeWhen($list->donation_type == "정기기부", "history.include.monthly")
            @includeWhen($list->donation_type == "분할납부", "history.include.divide")
        @empty
        @endforelse
    </ul>{{-- .history-list end --}}

    <div class="btn-more__wrap">
        <button class="btn-more">납입내역 <i class="fas fa-chevron-right"></i></button>
    </div>

</div>{{-- .history-posts-wrap end --}}
<script>
    const posts = document.querySelectorAll(".history-wrap .history-posts-wrap ul li");

    Array.prototype.forEach.call(posts, function (i, v) {

        i.addEventListener("mouseover", function () {
            i.classList.add('on');
        });

        i.addEventListener("mouseleave", function () {
            i.classList.remove('on');
        });
    })
</script>
