<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_assignments as $deal_assignment)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_assignment->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>