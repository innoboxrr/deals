<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_products as $deal_product)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_product->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>