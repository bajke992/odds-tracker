@extends('layouts.app')

@section('content')
    @include('my-games.table', [
        'headers' => [
            ['field' => 'odds', 'title' => 'Kvota'],
            ['field' => 'parameter', 'title' => 'Parametar'],
            ['field' => 'home_win', 'title' => 'Domaćin pobedio'],
            ['field' => 'home_loose', 'title' => 'Domaćin izgubio'],
            ['field' => 'blank', 'title' => ''],
            ['field' => 'away_win', 'title' => 'Gost pobedio'],
            ['field' => 'away_loose', 'title' => 'Gost izgubio'],
        ],
        'items' => $items
    ])
@endsection