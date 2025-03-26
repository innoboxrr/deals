<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_router_executions as $deal_router_execution)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_router_execution->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>