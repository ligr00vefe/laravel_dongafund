<div>
    <div class="search-opener">
        <button type="button" id="searchOpener" class="search-opener__button">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <div class="page-header__search">
        <form action="">
            <input type="text" name="term" class="input-search" placeholder="검색어를 입력해주세요">
            <input type="hidden" name="category" value="{{$_GET['category'] ?? ""}}">
            <button class="btn-search">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

<script>
    const searchOpener = document.querySelector("#searchOpener");
    const searchForm = document.querySelector(".page-header__search");

    searchOpener.onclick = function () {
        this.style.display = "none";
        searchForm.style.display = "inline-block";
        document.querySelector(".page-header__search .input-search, .page-header__search .btn-search").style.display = "inline-block";
        document.querySelector(".page-header__search .btn-search i").style.display = "inline-block"
    }
</script>

<style>
    @media(max-width: 768px) {

        .page-header__search {
            display: none;
        }

        .page-header__search .btn-search i {
            display: none;
        }
    }
</style>
