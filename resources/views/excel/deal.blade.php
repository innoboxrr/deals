<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deals as $deal)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>