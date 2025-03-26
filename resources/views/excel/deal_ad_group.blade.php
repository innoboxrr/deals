<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_ad_groups as $deal_ad_group)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_ad_group->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>