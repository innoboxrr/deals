<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ad_campaign_rules as $deal_ad_campaign_rule)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad_campaign_rule->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>