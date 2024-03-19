<script>
    $(document).ready(function(){
        $('.btn-search-re').click(function(){
            $('.page-header__search').addClass('on');
        });
        !$('.btn-search-re').click(function(){
            $('.page-header__search').addClass('on');
        });

        let routename = "{{ routename() }}";

        switch (routename)
        {
            case "news.index":
            case "news.show":
                document.querySelector("li[data-target='news.index']").classList.add("focused");
                break;
            case "periodicals.index":
                document.querySelector("li[data-target='periodicals.index']").classList.add("focused");
                break;
            case "status.index":
                document.querySelector("li[data-target='status.index']").classList.add("focused");
                break;
            case "history.index":
                document.querySelector("li[data-target='history.index']").classList.add("focused");
                break;
            case "receipt.index":
                document.querySelector("li[data-target='receipt.index']").classList.add("focused");
                break;
            case "fame.index":
                document.querySelector("li[data-target='fame.index']").classList.add("focused");
                break;
            case "benefit.index":
                document.querySelector("li[data-target='benefit.index']").classList.add("focused");
                break;

        }
    });
</script>


<div class="donor-lounge__menu">
    <ul>
        <li class="" data-target="news.index">
            <a href="/news">
                <i class="fas fa-newspaper"></i>
                <span>기부소식</span>
            </a>
        </li>
        <li class="" data-target="periodicals.index">
            <a href="/periodicals">
                <i class="fas fa-book"></i>
                <span>정기간행물</span>
            </a>
        </li>
        <li class="" data-target="status.index">
            <a href="/status">
                <i class="fas fa-chart-line"></i>
                <span>모금현황</span>
            </a>
        </li>
        {{--            <li class="{{ focused($loungeType, "fame") }}">--}}
        {{--                <a href="/fame?loungeType=fame">--}}
        {{--                    <i class="fas fa-university"></i>--}}
        {{--                    <span>명예의전당</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        <li class="" data-target="fame.index">
            <a href="/fame">
                <i class="fas fa-hand-holding-heart"></i>
                <span>기부자 예우</span>
            </a>
        </li>
        <li class="" data-target="benefit.index">
            <a href="/benefit">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>세제혜택</span>
            </a>
        </li>
{{--        <li class="" data-target="history.index">--}}
{{--            <a href="/history">--}}
{{--                <i class="fas fa-search"></i>--}}
{{--                <span>기부내역 조회</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="" data-target="receipt.index">--}}
{{--            <a href="/receipt">--}}
{{--                <i class="fas fa-receipt"></i>--}}
{{--                <span>기부금 영수증</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</div>{{-- .donor-lounge__menu end --}}
