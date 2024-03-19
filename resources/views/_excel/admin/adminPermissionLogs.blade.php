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
                {{ $content->id }}
            </td>
            <td>
                {{ $content->action }}
            </td>
            <td>
                {{ $content->target ?? "" }}
            </td>
            <td>
                {{ $content->name ?? "" }}
            </td>
            <td>
                {{ $content->comment }}
            </td>
            <td>
                {{ date("Y-m-d H:i:s", strtotime($content->created_at)) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
