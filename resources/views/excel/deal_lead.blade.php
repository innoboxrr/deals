<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_leads as $deal_lead)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_lead->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>