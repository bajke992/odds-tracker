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
                    {!! $item->id !!}
                </td>
                <td>
                    {!! $item->odds !!}
                </td>
                <td>
                    {!! $item->result !!}
                </td>
                <td>
                    {!! $item->parameter !!}
                </td>
                <td>
                    {!! ucfirst($item->type) !!}
                </td>
                <td class="@if($item->status === 'success')light-green white-text @elseif($item->status === 'fail')red lighten-2 white-text @endif">
                    {!! ucfirst($item->status) !!}
                </td>
                <td>
                    {!! $item->league->name !!}
                </td>
                <td>
                    @foreach($actions as $action)
                        <a href="{{ URL::route($action['route'], ['id' => $item->id]) }}" class="btn-floating red lighten-2 @if(isset($action['tooltip'])) tooltipped @endif" @if(isset($action['tooltip'])) data-position="top" @endif @if(isset($action['tooltip'])) data-tooltip="{{$action['tooltip']}}" @endif><i class="material-icons">{!! $action['icon'] !!}</i></a>
                    @endforeach
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