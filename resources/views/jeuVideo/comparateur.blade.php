@extends('base')
@section('css')
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
        .comparator_item {
            display: flex;
            flex-direction: column;
            margin: 15px 0px 15px 0px;
            padding: 5px;
        }
        .comparator_header {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 1px solid #bdc3c7;
            padding: 30px;
        }

        .comparator_item:nth-child(2n) {
            background-color: #bdc3c7;
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
                
                <!-- HEADER OF COMPARATOR-->
                <div class="comparator_row">
                    <div class="comparator_column">
                        <div class="comparator_header"></div>
                    </div>
                    @foreach ($games as $id => $game)
                        <div class="comparator_column">
                            <a href="/videoGameDetail/{{$id}}">
                                <div class="comparator_header">
                                    <img src="{{ asset("Photos/".$game['Image']) }}" alt="" class="game_line_img">
                                    {{$game['Nom']}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- CONTENT OF COMPARATOR -->
                <div class="comparator_row">

                    <!-- NAMES OF STATS (PrixTTC, Editeur...) -->
                    <div class="comparator_column">
                    @foreach($stats as $stat)
                        <div class="comparator_item">
                            {{$stat}}
                        </div>
                    @endforeach
                    </div>

                    <!-- STATS OF EACH GAME -->
                    @foreach ($games as $game)
                    <div class="comparator_column">
                        @foreach($stats as $stat)
                        <div class="comparator_item">
                            <!-- Different display depending on the stat -->
                            @if($stat=="Note moyenne")
                                <x-stars_notation :note="$game[$stat]"/>
                            @elseif($stat=="Age légal")
                            {{ $game[$stat] ? $game[$stat] : "---" }}
                            @elseif($stat=="Disponibilité")
                                @if($game[$stat])
                                    <p class="game_line_in_stock"><i class="fas fa-check-circle icon_game_line"></i> En stock </p>
                                @else
                                    <p class="game_line_out_of_stock"><i class="fas fa-times-circle icon_game_line"></i> Rupture de stock </p>
                                @endif
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
            
            <!-- EMPTY COMPARATOR BUTTON -->
            <div class="button" onclick="deleteFromSession()">
                <input type="hidden" name="key" value="comparateur" id="session_key">
                <i class="fas fa-trash"></i>Vider le comparateur
            </div>

        @else
            <!-- "NO GAMES" DISPLAY -->
            Aucun jeux dans le comparateur
            <a class="button" href="{{route('home')}}">
                Ajouter des jeux
            </a>
        @endif
    </div>
@endsection