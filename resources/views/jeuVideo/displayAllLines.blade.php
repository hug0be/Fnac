@extends('base')

@section('content')
<h1>🐣</h1>

@foreach ($videoGames as $videoGame)
    {{$videoGame->jeu_nom}}
    @foreach ($videoGame->rayons as $rayon)
        <p>{{ $rayon->ray_nom }}</p>
    @endforeach

@endforeach
@endsection