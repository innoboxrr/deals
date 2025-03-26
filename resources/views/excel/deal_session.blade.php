<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_sessions as $deal_session)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_session->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>