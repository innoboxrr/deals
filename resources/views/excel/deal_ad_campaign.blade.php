<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ad_campaigns as $deal_ad_campaign)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad_campaign->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>