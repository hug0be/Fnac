<div class="container_game_line">

    <div class="container_game_line_content">


    <div class="game_line_container_img">
        <a href="{{ route("detailVideoGame", ['idGame' => $videoGame->jeu_id ]) }}" class="game_line_link_img">
            <img src="{{asset("Photos/".$videoGame->photoList()->first()->url())}}" alt="" class="game_line_img">
        </a>
    </div>

        <div class="game_line_container_infos">

            <a href="{{ route("detailVideoGame", ['idGame' => $videoGame->jeu_id ]) }}" class="game_line_infos_link">{{$videoGame->jeu_nom}}</a>
            <a href="#" class="game_line_infos_link game_line_infos_link_editor">{{$videoGame->editeur->edi_nom}}</a>

    
         
            <div class="game_line_infos_tab_mid_container">
    
                <div class="game_line_infos_tab_mid_left">
                    <p class="game_line_info_console" >{{$videoGame->console->con_nom}} - </p>
                    <p>{{$videoGame->editeur->edi_nom}} - </p>
                    <p>{{$videoGame->jeu_publiclegal}} - </p>
                    <p>
                        {{ $videoGame->jeu_dateparution->translatedFormat('F Y ') }}
                    </p>

                </div>
    
                <div class="game_line_infos_tab_mid_right">

                    @if ($videoGame->jeu_stock > 0)
                        <p class="game_line_in_stock" > <i class="fas fa-check-circle icon_game_line"></i> En stock </p>
                    @else
                        <p class="game_line_out_of_stock" > <i class="fas fa-times-circle icon_game_line"></i> Rupture de stock </p>
                    @endif

                   
                </div>
    
    
            </div>
        </div>

        @include('jeuVideo/form_Favori')


        <div class="game_line_container_price_add_cart">

            <div class="game_line_container_price_values">

                <div class="game_line_price_first_value">
                   
                    {{ $videoGame->prixTTCeuro() }}
                </div>


                <div class="game_line_price_second_value">

                    €{{ $videoGame->prixTTCcentime() }}
                </div>

            </div>

            
            


            @include('jeuVideo.form_AjoutPanier')

        </div>
     
    </div>

</div>
