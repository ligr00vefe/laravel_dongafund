<li>
    <div class="hist__head">
        <div class="hist__head-con con__left">
            <i class="fas fa-donate"></i>
            <span>
                {{ $list->subject }}
            </span>
        </div>
        <div class="hist__head-con con__right">
            @if (isset($list->completed) && $list->completed > 0)
                <p>일시기부</p>
                <p>납입완료</p>
            @else
                <p>일시기부</p>
                <p>납입대기</p>
            @endif
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
                    {{ number_format($list->donate_price ?? 0) }}원
                </p>
            </li>
            <li>
                <span>납입일</span>
                <p>
                    {{ date("Y-m-d", strtotime($list->created_at)) }}
                </p>
            </li>
            <li>
                <span>납입금액</span>
                @if (isset($list->completed) && $list->completed > 0)
                    <p>
                        {{ number_format($list->total_price ?? 0) }}
                    </p>
                @else
                    <p>0</p>
                @endif
            </li>
        </ol>
    </div>{{-- .hist__body--}}
</li>
