@extends('layouts.search')

@section('searchContent')
    @include('search.table', [
        'headers' => [
            ['field' => 'my_games', 'title' => 'My games'],
            ['field' => 'odds', 'title' => 'Kvota'],
            ['field' => 'result', 'title' => 'Rezultat'],
            ['field' => 'parameter', 'title' => 'Parametar'],
            ['field' => 'status', 'title' => 'Stanje'],
            ['field' => 'league_id', 'title' => 'Liga'],
            ['field' => 'actions', 'title' => 'Actions'],
        ],
        'actions' => [
            ['icon' => 'replay', 'route' => 'matches.duplicate', 'tooltip' => 'Dupliraj utakmicu'],
            ['icon' => 'mode_edit', 'route' => 'matches.update', 'tooltip' => 'Izmeni utakmicu'],
        ],
        'items' => $items
    ])
@endsection