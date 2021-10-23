@extends('base')
@section('css')
    <link rel="stylesheet" href="{{ asset("css/content/content-home.css") }}">
    <style>
        .comparator_container {
            font-size: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        .comparator_row {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .comparator_column {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: end;
        }
        .comparator_column_item {
            display: flex;
            flex-direction: column;
            margin: 15px 0px 15px 0px;
            padding: 5px;
        }
        .comparator_column_header {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 1px solid #bdc3c7;
            padding: 30px;
        }

        .comparator_column_item:nth-child(2n) {
            background-color: #bdc3c7;
        }

        .button {
            background-color: #f5b027;
            margin-top: 15px;
            font-size: 15px;
            width: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.5vw 0;
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
        img {
            width:40%;
        }
    </style>
@endsection 

@section('content')
    <div class="container_title  margin_top_content">
    <h2 class="subTitle_contact_info">Comparateur</h2>
        @if(!empty($games))
            <div class="comparator_container">
                <div class="comparator_row">
                    <div class="comparator_column">
                        <div class="comparator_column_header"></div>
                    </div>
                    @foreach ($games as $id => $game)
                        <div class="comparator_column">
                            <a href="/videoGameDetail/{{$id}}">
                                <div class="comparator_column_header">
                                    <img src="{{ asset("Photos/".$game['Image']) }}" alt="" class="game_line_img">
                                    {{$game['Nom']}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="comparator_row">
                    <div class="comparator_column stats_column">
                        @foreach($stats as $stat)
                            <div class="comparator_column_item">
                                <div>{{$stat}}</div>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($games as $game)
                    <div class="comparator_column">
                        @foreach($stats as $stat)
                            <div class="comparator_column_item">
                                @if($stat=="Note moyenne")
                                {{ $game[$stat] ? round($game[$stat],2) : "---" }}
                                @elseif($stat=="Age légal")
                                {{ $game[$stat] ? $game[$stat] : "---" }}
                                @elseif($stat=="PrixTTC")
                                {{ $game[$stat] }} €
                                @elseif($stat=="Date de parution")
                                {{$game[$stat]->translatedFormat('d/m/Y')}}
                                @else
                                {{$game[$stat]}}
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>  
            
            <div class="button" onclick="deleteFromSession()">
                <input type="hidden" name="key" value="comparateur" id="session_key">
                <i class="fas fa-trash"></i>Vider le comparateur
            </div>
        @else
            Aucun jeux dans le comparateur
            <a class="button" href="{{route('home')}}">
                Ajouter des jeux
            </a>
        @endif
    </div>
@endsection