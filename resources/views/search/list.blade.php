@extends('layouts.search')

@section('searchContent')
    {{--{{ $items }}--}}

    @include('search.table', [
        'headers' => [
            ['field' => 'odds', 'title' => 'Kvota'],
            ['field' => 'result', 'title' => 'Rezultat'],
            ['field' => 'parameter', 'title' => 'Parametar'],
            ['field' => 'type', 'title' => 'Domaćin/Gost'],
            ['field' => 'status', 'title' => 'Stanje'],
            ['field' => 'league_id', 'title' => 'Liga']
        ],
        'items' => $items
    ])
@endsection