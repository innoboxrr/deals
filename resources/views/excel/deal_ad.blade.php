<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ads as $deal_ad)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>