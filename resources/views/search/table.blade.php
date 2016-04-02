<div class="row">
    <div class="row col s12">
        <div class="col s6 success-chart"></div>
        <div class="col s6 fail-chart"></div>
    </div>
    <div class="col s6">
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
                @if($item->status === \App\Models\Match::STATUS_IN_PLAY)
                    <tr>
                        <td>
                            @include('components.checkbox', ['id' => $item->id, 'checked' => $item->my_games, 'label' => ''])
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
                        <td class="@if($item->status === 'success')light-green white-text @elseif($item->status === 'fail')red lighten-2 white-text @endif">
                            {!! ucfirst($item->type) !!}
                        </td>
                        <td>
                            {!! $item->league->name !!}
                        </td>
                        <td>
                            @foreach($actions as $action)
                                <a href="{{ URL::route($action['route'], ['id' => $item->id]) }}"
                                   class="btn-floating red lighten-2 @if(isset($action['tooltip'])) tooltipped @endif"
                                   @if(isset($action['tooltip'])) data-position="top"
                                   @endif @if(isset($action['tooltip'])) data-tooltip="{{$action['tooltip']}}" @endif><i
                                            class="material-icons">{!! $action['icon'] !!}</i></a>
                            @endforeach
                        </td>
                        @if($item->comment !== null)
                            <td class="comment light-blue tooltipped" data-position="left"
                                data-tooltip="{{ $item->comment }}"></td>
                        @endif
                    </tr>
                @endif
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
    <div class="col s6">
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
                @if($item->status === \App\Models\Match::STATUS_FINISHED)
                    <tr>
                        <td>
                            @include('components.checkbox', ['id' => $item->id, 'checked' => $item->my_games, 'label' => ''])
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
                        <td class="@if($item->status === 'success')light-green white-text @elseif($item->status === 'fail')red lighten-2 white-text @endif">
                            {!! ucfirst($item->type) !!}
                        </td>
                        <td>
                            {!! $item->league->name !!}
                        </td>
                        <td>
                            @foreach($actions as $action)
                                <a href="{{ URL::route($action['route'], ['id' => $item->id]) }}"
                                   class="btn-floating red lighten-2 @if(isset($action['tooltip'])) tooltipped @endif"
                                   @if(isset($action['tooltip'])) data-position="top"
                                   @endif @if(isset($action['tooltip'])) data-tooltip="{{$action['tooltip']}}" @endif><i
                                            class="material-icons">{!! $action['icon'] !!}</i></a>
                            @endforeach
                        </td>
                        @if($item->comment !== null)
                            <td class="comment light-blue tooltipped" data-position="left"
                                data-tooltip="{{ $item->comment }}"></td>
                        @endif
                    </tr>
                @endif
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

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            $('[id^=filled-in-box-]').on('change', function () {
                $id = $(this).data('id');

                $.ajax({
                    url: '{{ URL::route('match.my-games.toggle', ['']) }}/' + $id,
                    type: 'GET',
                    success: function (response) {
                        if (response.toggle == 1) {
                            flashMessage('Utakmica dodata u "Moje igre"!');
                        } else {
                            flashMessage('Utakmica uklonjena iz "Moje igre"!');
                        }
                    }
                });
            });

            $successCount = {!! $success !!};
            $failCount = {!! $fail !!};

            $result = calculatePercent($successCount, $failCount);

            $successSettings = {
                stroke: {
                    width: 10,
                    gap: 10
                },
                shadow: {
                    width: 0
                },
                diameter: 50,
                series: [
                    {
                        value: $result.success,
                        color: '#8bc34a'
                    }
                ],
                center: $result.success+"%"
            };

            $failSettings = {
                stroke: {
                    width: 10,
                    gap: 10
                },
                shadow: {
                    width: 0
                },
                diameter: 50,
                series: [
                    {
                        value: $result.fail,
                        color: '#e57373'
                    }
                ],
                center: $result.fail+"%"
            };

            var successChart = new RadialProgressChart('.success-chart', $successSettings);
            var failChart = new RadialProgressChart('.fail-chart', $failSettings);
        });

        function calculatePercent($success, $fail) {
            var total = $success + $fail;
            var successResult = Math.round((($success * 100) / total) * 100) / 100;
            var failResult = Math.round((($fail * 100) / total) * 100) / 100;

            return {success: successResult, fail: failResult};
        }
    </script>
@endsection