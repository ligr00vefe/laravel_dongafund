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
                {{ $content->name ?: "익명" }}
            </td>
            <td>
                {{ $content->tel ?: "익명" }}
            </td>
            <td>
                {{ $content->menu }}
            </td>
            <td>
                {{ $content->category }}
            </td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
