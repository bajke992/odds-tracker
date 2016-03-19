@extends('layouts.crudNav')

@section('crudContent')
    <div class="row">
        <a href="{{ URL::route('matches.create') }}" class="btn">Napravi</a>
    </div>

    @yield('matchContent')
@endsection