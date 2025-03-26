<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_postbacks as $deal_advertiser_agreement_postback)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_postback->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>