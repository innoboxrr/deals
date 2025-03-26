<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_lead_tracking_events as $deal_lead_tracking_event)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_lead_tracking_event->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>