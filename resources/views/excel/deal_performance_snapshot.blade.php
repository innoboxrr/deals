<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_performance_snapshots as $deal_performance_snapshot)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_performance_snapshot->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>