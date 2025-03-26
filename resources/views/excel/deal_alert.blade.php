<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_alerts as $deal_alert)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_alert->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>