@extends('layouts.league')

@section('leagueContent')
    <div class="row">
        <form action="" method="POST">
            {!! csrf_field() !!}
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="name" class="validate" value="{{ ($league->name !== null) ? $league->name : old('name') }}" name="name"/>
                    <label for="name">Naziv</label>
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