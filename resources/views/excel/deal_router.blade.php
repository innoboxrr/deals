<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_routers as $deal_router)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_router->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>