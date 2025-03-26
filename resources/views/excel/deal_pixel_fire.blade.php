<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_pixel_fires as $deal_pixel_fire)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_pixel_fire->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>