@extends('layouts.app')

@section('content')
    {{--<div class="row">--}}
        {{--<a href="{{ URL::route('leagues.home') }}" class="btn">Lige</a>--}}
        {{--<a href="#" class="btn">Utakmice</a>--}}
    {{--</div>--}}
    @yield('crudContent')
@endsection