<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_invoices as $deal_advertiser_agreement_invoice)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_invoice->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>