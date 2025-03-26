<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_payment_methods as $deal_advertiser_payment_method)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_payment_method->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>