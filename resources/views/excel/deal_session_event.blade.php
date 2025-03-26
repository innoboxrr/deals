<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_session_events as $deal_session_event)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_session_event->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>