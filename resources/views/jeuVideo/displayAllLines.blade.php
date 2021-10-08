@extends('base')

@section('content')
<h1>🐣</h1>

<div>
    @foreach ($videoGames as $videoGame)
    <div>
    <p>{{$videoGame->jeu_nom}} </p>
    @foreach ($videoGame->photo as $photo)
        <img src="{{asset("Photos/".$photo->pho_url)}}" alt="">
    @endforeach
    </div>
       
    @endforeach
</div>

@endsection