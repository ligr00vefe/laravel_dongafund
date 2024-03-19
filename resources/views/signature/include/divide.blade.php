<table>
    <tr>
        <th>
            <p>기부방식</p>
        </th>
        <td>
            {{ $donation->donation_type }}
        </td>
    </tr>
    <tr>
        <th>
            <p>총 기부금액</p>
        </th>
        <td>
            {{ number_format(regexp("숫자", $donation->donation_price)) }}원
        </td>
    </tr>
    <tr>
        <th>
            <p>
                분할횟수
            </p>
        </th>
        <td>
            {{ $donation->divide_count }}회
        </td>
    </tr>
    <tr>
        <th>
            <p>
                월 기부금액
            </p>
        </th>
        <td>
            {{ $donation->divide_count }}개월 간 매달 {{ number_format(regexp("숫자", $donation->donation_price) / $donation->divide_count) }}원
        </td>
    </tr>
    <tr>
        <th>
            <p>납입방법</p>
        </th>
        <td>
            {{ $donation->payment_type }}
        </td>
    </tr>
    @if ($donation->payment_type == "자동이체")
    <tr>
        <th>
            <p>
                결제일
            </p>
        </th>
        <td>
            매달 {{ $donation->automatic_transfer_assign_day }}일
        </td>
    </tr>
    <tr>
        <th>
            <p>
                은행명
            </p>
        </th>
        <td>
            {{ $donation->automatic_bank_name }}
        </td>
    </tr>
    <tr>
        <th>
            <p>
                계좌번호
            </p>
        </th>
        <td>
            {{ $donation->automatic_bank_number }}
        </td>
    </tr>
    @endif

    <tr>
        <th>
            <p>
                {{ $donation->donator_type == "법인" ? "법인명" : "기부자명" }}
            </p>
        </th>
        <td>
            {{ $donation->name }}
        </td>
    </tr>
    <tr>
        <th>
            <p>연락처</p>
        </th>
        <td>
            {{ $donation->tel }}
        </td>
    </tr>
    <tr>
        <th>
            <p>
                {{ $donation->donator_type == "법인" ? "사업자등록번호" : "주민등록번호" }}
            </p>
        </th>
        <td>
            {{ $donation->regNumber }}
        </td>
    </tr>
    <tr>
        <th>
            <p>주소</p>
        </th>
        <td>
            {{ $donation->address1 . $donation->address2 }}
        </td>
    </tr>

</table>
