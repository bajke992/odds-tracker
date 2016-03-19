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
                @if($item->status === 'success')
                    <tr>
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
                @if($item->status === 'fail')
                    <tr>
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

        function calculatePercent($success, $fail){
            var $successResult, $failResult;
            var $high;
            if($success > $fail) {
                if($fail === 0){
                    return {success: 100, fail: 0};
                }

                $high = ($fail/$success)*100;
                $successResult = $high;
                $failResult = 100 - $high;

                return {success: $successResult, fail: $failResult};
            }

            if($fail > $success) {
                if($success === 0){
                    return {success: 0, fail: 100};
                }

                $high = ($success/$fail)*100;
                $failResult = $high;
                $successResult = 100 - $failResult;

                return {success: $successResult, fail: $failResult};
            }

            return {success: 50, fail: 50};
        }
    </script>
@endsection