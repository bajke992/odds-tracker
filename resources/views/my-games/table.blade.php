<div class="row">
    <div class="col s12">
        <table class="bordered centered">
            <thead>
            @foreach($headers as $header)
                <th data-field="{!! $header['field'] !!}">
                    {!! $header['title'] !!}
                </th>
            @endforeach
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td>
                        {{ $item['odds'] }}
                    </td>
                    <td>
                        {{ $item['parameter'] }}
                    </td>
                    <td>
                        {{ round($item['home']['success'], 2) }}%
                    </td>
                    <td>
                        {{ round($item['home']['fail'], 2) }}%
                    </td>
                    <td class="red lighten-2"></td>
                    <td>
                        {{ round($item['away']['success'], 2) }}%
                    </td>
                    <td>
                        {{ round($item['away']['fail'], 2) }}%
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <strong>Nema podataka!</strong>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>