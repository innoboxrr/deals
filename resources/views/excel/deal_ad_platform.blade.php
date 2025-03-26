<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ad_platforms as $deal_ad_platform)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad_platform->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>