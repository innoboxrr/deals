<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertisers as $deal_advertiser)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>