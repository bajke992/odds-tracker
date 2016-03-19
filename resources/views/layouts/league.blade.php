@extends('layouts.crudNav')

@section('crudContent')
    <div class="row">
        <a href="{{ URL::route('leagues.create') }}" class="btn">Napravi</a>
    </div>

    @yield('leagueContent')
@endsection