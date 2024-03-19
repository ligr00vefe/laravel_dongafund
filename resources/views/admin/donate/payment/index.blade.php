@extends("layouts/admin")

@section("title")
    기부금 관리 <i class="fa fa-chevron-right" style="margin:0 8px;"></i> 결제/승인 내역
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" type="text/css" href="/css/pickday_white.css">
@endpush

@section("content")
    <div class="contents-header">
        <ul class="dis-ib ff-paybookbold">
            <li class="{{ $category ?: "focused" }} t1">
                <a href="/{{ $adminUrlPrefix }}/donate/payment">
                    전체보기
                </a>
            </li>
            <li class="{{ focused($category, "나이스페이") }} t2">
                <a href="/{{ $adminUrlPrefix }}/donate/payment?payment_type=신용카드">
                   카드(나이스)
                </a>
            </li>
            <li class="{{ focused($category, "KSNet") }} t3">
                <a href="javascript:alert('준비중입니다')">
                    카드(KSNet)
                </a>
            </li>
            <li class="{{ focused($category, "카카오페이") }} t4">
                <a href="/{{ $adminUrlPrefix }}/donate/payment?payment_type=카카오페이">
                    카카오페이
                </a>
            </li>
            <li class="{{ focused($category, "네이버페이") }} t4">
                <a href="javascript:alert('준비중입니다')">
                    네이버페이
                </a>
            </li>
            <li class="{{ focused($category, "썸패스") }} t4">
                <a href="javascript:alert('준비중입니다')">
                    썸패스
                </a>
            </li>
        </ul>

    </div>{{-- .contents-header end --}}

    <div class="contents-body">
        <div class="search-wrap">

            <div class="search-con__left">
                <div class="search-date">
                    <form action="">
                        <input type="text" id="from_date" name="from_date" placeholder="yyyy-mm-dd"
                               autocomplete="false" readonly value="{{ $from_date ?? "" }}">
                        <span>~</span>
                        <input type="text" id="to_date" name="to_date" placeholder="yyyy-mm-dd"
                               autocomplete="false" readonly value="{{ $to_date ?? "" }}">
                        <select class="contract-search arrow-hide" name="payment_type" id="payment_method">
                            <option value="" hidden>결제수단</option>
                            <option value="신용카드">나이스페이</option>
                            <option value="카카오페이">카카오페이</option>
                        </select>
                        <button type="submit" value="조회"><i class="fas fa-filter"></i>조회</button>
                    </form>
                </div>
            </div>
        </div>{{-- .search-wrap end --}}

        <div class="contents-list">
            <table>
                <thead>
                <tr>
                    <th class="">선택</th>
                    <th class="">웹 승인번호</th>
                    <th class="">웹 약정번호</th>
                    <th class="">회원번호</th>
                    <th class="">증서번호</th>
                    <th class="">결제수단</th>
                    <th class="">승인일시</th>
                    <th class="">승인금액</th>
                    <th class="">결제사 거래번호</th>
                    <th class="">결제상태</th>
                    <th class="">연동여부</th>
                </tr>
                </thead>
                <tbody>
                @forelse($lists as $list)
                <tr>
                    <td>
                        <input type="checkbox" name="check[]" value="{{ $list->id }}">
                    </td>
                    <td>
                        {{ $list->id }}
                    </td>
                    <td>
                        {{ $list->contract_code ?? "" }}
                    </td>
                    <td>
                        {{ "" }}
                    </td>
                    <td>
                        {{ "증서번호" }}
                    </td>
                    <td>
                        {{ $list->payment_type }}
                    </td>
                    <td>
                        {{ $list->created_at }}
                    </td>
                    <td>
                        {{ $list->divide_price ?? $list->donation_price }}
                    </td>
                    <td>
                        {{ "" }}
                    </td>
                    <td>
                        {{ $list->status == "1" ? "결제완료" : "결제대기" }}
                    </td>
                    <td>
                        연동대기
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="11"></td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $lists->withQueryString()->onEachSide(3)->links("vendor.pagination.custom") }}
            </div>

        </div>{{-- .contents-list end --}}



        <div class="btn-wrap btn-index btn-wide">
            <a href="javascript:void(0)" class="btn-excel-down btn-float-left"><i class="fas fa-trash-alt"></i>서면약정서 삭제</a>

            <a href="/{{ $adminUrlPrefix }}/donate/excel/contract" class="btn-excel-down"><i class="fas fa-pen"></i>약정서 등록</a>
            <form action="/{{ $adminUrlPrefix }}/excel/export/payment" method="POST">
                @csrf
                <button class="btn-excel-down"><i class="fas fa-file-excel"></i>목록 다운로드</button>
            </form>
            <a href="/{{ $adminUrlPrefix }}/donate/sending/contract" class="btn-excel-down"><i class="fas fa-share-alt"></i>발전기금시스템 전송</a>
        </div>
    </div>{{-- .contents-body end --}}


@endsection
