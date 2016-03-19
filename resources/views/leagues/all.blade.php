@extends('layouts.league')

@section('leagueContent')
    @include('leagues.components.table', [
        'headers' => [
            ['field' => 'id', 'title' => 'ID'],
            ['field' => 'name', 'title' => 'Name'],
            ['field' => 'actions', 'title' => 'Actions']
        ],
        'items' => $leagues,
        'actions' => [
            ['icon' => 'mode_edit', 'route' => 'leagues.update', 'tooltip' => 'Izmeni ligu'],
            ['icon' => 'delete', 'route' => 'leagues.delete', 'tooltip' => 'Obriši ligu']
        ]
    ])

@endsection