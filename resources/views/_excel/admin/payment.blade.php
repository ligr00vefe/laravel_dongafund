<table>
    <thead>
    <tr style="height: 50px; vertical-align: top;">
        @foreach ($heads as $head)
            <th align="center" style="background-color: #778beb; color: #ffffff; padding: 15px 0; font-weight: bold; height: 30px; text-align: center; vertical-align: center; font-size: 14px;">{{ $head }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($contents as $content)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $content->id }}
            </td>
            <td>
                {{ $content->contract_code }}
            </td>
            <td>
                {{ "" }}
            </td>
            <td>
                {{ "증서번호" }}
            </td>
            <td>
                {{ $content->payment_type }}
            </td>
            <td>
                {{ $content->created_at }}
            </td>
            <td>
                {{ $content->divide_price ?? $content->donation_price }}
            </td>
            <td>
                {{ "" }}
            </td>
            <td>
                {{ $content->status == "1" ? "결제완료" : "결제대기" }}
            </td>
            <td>
                연동대기
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
