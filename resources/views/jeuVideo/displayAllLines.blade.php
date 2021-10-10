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

    <div class="menu_nav_sidebar">
        <h4 class="menu_nav_sidebar_title">
            <a href="{{ route('home') }}">
                TOUS LES RAYONS
            </a>
        </h4>

        
            @foreach ($rayons as $rayon)
                <div class="menu_nav_sidebar_container_link">
                    <a href="{{route("searchByRayon", ['idRayon' => $rayon->ray_id]);}}" class="link_menu_nav_sidebar" >{{ $rayon->ray_nom}}</a>
                </div>
            @endforeach

        
    </div>



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