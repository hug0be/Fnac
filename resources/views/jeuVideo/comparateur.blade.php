@extends('base')
@section('css')
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <style>
        table {
            border:1px solid black;
            text-align: center;
        }
        td, th {
            padding : 5px;
        }
        .button {
            background-color: #f5b027;
            margin-top: 15px;
            font-size: 15px;
            width: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1vw 0;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
            color: #ffffff;
        }
        
        .button:hover {
            background-color: #f8c153;
        }

        .container_title {
            padding: 40px 20px;
            font-family: 'Roboto';
            font-size: 18px;
            font-weight: 300;
        }
    </style>
@endsection 

@section('content')
    <div class="container_title  margin_top_content">
        <div class="container_subTitle">
            <h2 class="subTitle_contact_info">Comparateur</h2>
        </div>
        <div class="button" onclick="deleteFromSession()">
            <input type="hidden" name="key" value="comparateur" id="session_key">
            <i class="fas fa-trash"></i>Vider le comparateur
        </div>
        <table>
            <thead>
                @foreach($statsList as $stat)
                <th>{{$stat}}</th>
                @endforeach
            </thead>
            @if(!empty($statsJeux))
                @foreach ($statsJeux as $idJeu => $statsJeu)
                    <x-comparator-line :stats-jeu="$statsJeu" :id-jeu="$idJeu"/>
                @endforeach
            @else
                <tr>
                    <td colspan="{{count($statsList)}}">Aucun jeux dans le comparateur</td>
                </tr>
            @endif
        </table>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset("js/session.js") }}"></script>
@endsection