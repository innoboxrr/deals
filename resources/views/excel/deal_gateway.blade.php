<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_gateways as $deal_gateway)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_gateway->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>