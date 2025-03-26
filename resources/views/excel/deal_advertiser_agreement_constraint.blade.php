<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_constraints as $deal_advertiser_agreement_constraint)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_constraint->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>