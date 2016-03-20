@extends('layouts.match')

@section('matchContent')
    <div class="row">
        <form action="" method="POST">
            {!! csrf_field() !!}
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="odds" class="validate" value="{{ ($match->odds !== null) ? $match->odds: old('odds') }}" name="odds"/>
                    <label for="odds">Kvota</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" id="x" class="validate" value="{{ ($match->x !== null) ? $match->x: old('x') }}" name="x"/>
                    <label for="parameter">X (12)</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" id="y" class="validate" value="{{ ($match->y !== null) ? $match->y: old('y') }}" name="y"/>
                    <label for="parameter">Y (1X / X2)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="result" class="validate" value="{{ ($match->result !== null) ? $match->result: old('result') }}" name="result"/>
                    <label for="result">Rezultat</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="type" id="type" class="validate">
                        @foreach($types as $type)
                            <option @if(($type !== 'none') && in_array($type, [$selectedType]))selected @endif @if($type === 'none')selected disabled @endif value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    <label>Domaćin/Gost</label>
                </div>
                <div class="input-field col s6">
                    <select name="status" id="status" class="validate">
                        @foreach($statuses as $status)
                            <option @if(in_array($status, [$selectedStatus]))selected @endif value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <label>Status utakmice</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="league_id" id="league_id" class="validate">
                        <option selected disabled value="none">None</option>
                        @foreach($leagues as $k => $v)
                            <option @if(in_array($k, [$selectedLeague]))selected @endif value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    <label>Liga</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="comment" class="materialize-textarea" name="comment">{{ $match->comment }}</textarea>
                    <label for="comment">Komentar</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn pull-right" type="submit">Sačuvaj</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endsection