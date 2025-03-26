<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ad_performance_snapshots as $deal_ad_performance_snapshot)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad_performance_snapshot->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>