@extends('layouts.match')

@section('matchContent')
    @include('matches.components.table', [
        'headers' => [
            ['field' => 'id', 'title' => 'ID'],
            ['field' => 'odds', 'title' => 'Kvota'],
            ['field' => 'result', 'title' => 'Rezultat'],
            ['field' => 'parameter', 'title' => 'Parametar'],
            ['field' => 'type', 'title' => 'Domaćin/Gost'],
            ['field' => 'status', 'title' => 'Stanje'],
            ['field' => 'league_id', 'title' => 'Liga'],
            ['field' => 'actions', 'title' => 'Actions']
        ],
        'items' => $matches,
        'actions' => [
            ['icon' => 'mode_edit', 'route' => 'matches.update', 'tooltip' => 'Izmeni utakmicu'],
            ['icon' => 'delete', 'route' => 'matches.delete', 'tooltip' => 'Obriši utakmicu']
        ]
    ])

@endsection