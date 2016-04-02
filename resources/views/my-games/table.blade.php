<div class="row">
    {{--<div class="row col s12">--}}
    {{--<div class="col s6 success-chart"></div>--}}
    {{--<div class="col s6 fail-chart"></div>--}}
    {{--</div>--}}
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
                        {{ $item['home']['success'] }}%
                    </td>
                    <td>
                        {{ $item['home']['fail'] }}%
                    </td>
                    <td class="red lighten-2"></td>
                    <td>
                        {{ $item['away']['success'] }}%
                    </td>
                    <td>
                        {{ $item['away']['fail'] }}%
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