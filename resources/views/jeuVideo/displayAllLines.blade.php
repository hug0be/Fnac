@extends('base')

{{-- 
@section('css')
    <link rel="stylesheet" href="{{ asset("css/header/header.css") }}">
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">

@endsection

@section('content')
{{-- <h1>🐣</h1> --}}

<div class="container_all_game_line margin_top_content" >

    @include('layout.menu')

    <div class="container_all_game_line_content">
        @foreach ($videoGames as $videoGame)
            @include('jeuVideo.displayLine')
        @endforeach
    </div>

</div>

@endsection



@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-home.js") }}"></script>
@endsection