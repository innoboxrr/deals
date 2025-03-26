<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($deal_advertiser_agreement_configs as $deal_advertiser_agreement_config)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $deal_advertiser_agreement_config->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>