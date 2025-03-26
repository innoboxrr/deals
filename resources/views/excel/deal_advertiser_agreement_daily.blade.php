<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_dailies as $deal_advertiser_agreement_daily)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_daily->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>