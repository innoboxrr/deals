<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreements as $deal_advertiser_agreement)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>