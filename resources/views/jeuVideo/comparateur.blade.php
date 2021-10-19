@extends('base')
{{-- THEOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO c'est utile ça ?
<link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-home.css") }}">
<link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
--}}
@section('css')
    <style>
        table {
            border:1px solid black;
        }
        td, th {
            padding : 5px;
        }
    </style>
@endsection 

@section('content')
    <div class="margin_top_content">COMPARATEUR

        {{ var_dump($session) }}
        <table>
                @foreach($statsList as $stat)
                    <th>{{$stat}}</th>
                @endforeach
                @foreach ($statsJeux as $idJeu => $statsJeu)
                    <x-comparator-line :stats-jeu="$statsJeu" :id-jeu="$idJeu"/>
                @endforeach
        </table>
    </div>
@endsection