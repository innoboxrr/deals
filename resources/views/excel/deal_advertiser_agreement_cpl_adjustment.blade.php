<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_cpl_adjustments as $deal_advertiser_agreement_cpl_adjustment)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_cpl_adjustment->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>