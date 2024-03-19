<li>
    <div class="hist__head">
        <div class="hist__head-con con__left">
            <i class="fas fa-donate"></i>
            <span>
                {{ $list->subject }}
            </span>
        </div>
        <div class="hist__head-con con__right">
            <p>정기기부</p>
            <p>납입중</p>
        </div>
    </div>{{-- .hist-top end--}}

    <div class="hist__body">
        <ol>
            <li>
                <span>약정일자</span>
                <p>
                    {{ date("Y-m-d", strtotime($list->created_at)) }}
                </p>
            </li>
            <li>
                <span>약정금액</span>
                <p>
                    월 {{ number_format($list->once_price ?? 0) }}원
                </p>
            </li>
            <li>
                <span>최근 납입일</span>
                @if ($list->last_subs_date)
                    <p>
                        {{ date("Y-m-d", strtotime($list->last_subs_date)) . "(" . getWeekDay($list->last_subs_date) . ")" }}
                    </p>
                @else
                    <p>
                        최근 납입일이 없습니다
                    </p>
                @endif
            </li>
            <li>
                <span>납입회차</span>
                <p>
                    {{ $list->completed ?? 0 }}회차
                </p>
            </li>
            <li>
                <span>납입금액</span>
                <p>
                    {{ number_format($list->total_price ?? 0) }}원
                </p>
            </li>
        </ol>
    </div>{{-- .hist__body--}}
</li>
