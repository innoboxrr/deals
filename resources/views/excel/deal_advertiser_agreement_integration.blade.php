<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_integrations as $deal_advertiser_agreement_integration)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_integration->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>