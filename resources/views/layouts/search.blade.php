@extends('layouts.app')

@section('content')
    <div class="row">
        <form class="col s12" action="" method="POST">
            <div class="row">
                {!! csrf_field() !!}
                <div class="input-field col s2 search">
                    <input type="text" id="odds" value="{{ old('odds') }}" name="odds"/>
                    <label for="odds">Kvota</label>
                </div>
                <div class="input-field col s2 search">
                    <input type="text" id="parameter" value="{{ old('parameter') }}" name="parameter"/>
                    <label for="parameter">Parametar</label>
                </div>
                <div class="input-field col s3 search">
                    <select name="type" id="type">
                        @foreach($types as $type)
                            <option @if($type === 'none')selected disabled @endif value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    <label>Domaćin/Gost</label>
                </div>
                <div class="input-field col s3 search">
                    <select name="league_id" id="league_id" class="validate">
                        <option selected disabled value="none">None</option>
                        @foreach($leagues as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    <label>Liga</label>
                </div>
                <div class="input-field col s2 search">
                    <button class="btn" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    @yield('searchContent')
@endsection
@section('js')
    @parent
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
@endsection