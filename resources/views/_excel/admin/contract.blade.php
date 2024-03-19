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
                {{ $content->contract_type }}
            </td>
            <td>
                {{ $content->name }}
            </td>
            <td>
                {{ $content->subject }}
            </td>
            <td>
                {{ $content->donation_price }}
            </td>
            <td>
                {{ $content->donation_type }}
            </td>
            <td>
                {{ $content->payment_type }}
            </td>
            <td>
                {{ $content->created_at }}
            </td>
            <td>
                {{ $content->contract_status == 1 ? "약정완료" : "" }}
            </td>
            <td>
                {{ $content->send_status_kor }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
