

@extends('base')


@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/content/content-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/form/form-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/form/form-videoGame-avis.css") }}">

@endsection


@section('header') 
    @include('layout.header-videoGame-detail')
@endsection


@section('content')

    {{-- <div class="menu_nav_sidebar">
        <h4 class="menu_nav_sidebar_title">TOUS LES RAYONS</h4>

        
            @foreach ($rayons as $rayon)
                <div class="menu_nav_sidebar_container_link">
                    <a href="{{route("searchByRayon", ['idRayon' => $rayon->ray_id]);}}" class="link_menu_nav_sidebar" >{{ $rayon->ray_nom }}</a>
                </div>
            @endforeach

        
    </div> --}}

    <div class="container_detail_game margin_top_content">


        @include('layout.menu')

        
        <div class="container_detail_game_content ">

            <div class="container_first_second_section detail_game_content_padding">
                <div class="container_detail_game_content_title_info ">
                    <x-input-error name="session"/> 
                    <h1 class="container_detail_game_content_title_h1" > {{ $videoGame->jeu_nom }} </h1>
                    <div class="detail_game_content_info_container">
                        <p class="detail_game_content_info_container_txt" >Jeu <span>-</span></p>
                        <p class="detail_game_content_info_container_txt" > {{ $videoGame->console->con_nom }} <span>-</span> </p>
                        <p class="detail_game_content_info_container_txt" >Paru le  {{ $videoGame->jeu_dateparution->translatedFormat(' jS F Y') }} </p>  
                    </div>
                </div>
    
    
                <div class="container_detail_game_content_imgs_price">
    
                    <div class="container_detail_game_content_imgs">
    
                        <div class="container_column_small_imgs">
    
    
                            @foreach ($videoGame->photoList as $photo)

                            @if (is_file(public_path("Photos/".$photo->pho_url)))
                            <div class="container_small_img">
                                <img src="{{asset("Photos/".$photo->pho_url)}}" alt="" class="game_detail_small_img">
                            </div>
                            @endif

                            @endforeach 
    
                            @foreach ($videoGame->videoList as $video)
                            @if (is_file(public_path("Videos/".$video->vid_url)))
                            <div class="container_small_img">
                                <video class="game_detail_small_img" preload="auto">
                    
                                    <source src="{{asset('Videos/'.$video->vid_url)}}" type="video/mp4">
                                
                                    Votre navigateur ne supporte pas les lecteurs de vidéos.
                                </video>
                            </div>
                            @endif
                        
    
                            @endforeach 


                                                
                            @include('jeuVideo/form_Photos')
                            @include('jeuVideo/form_Video')
      
    
                        </div>
    
    
                        <div class="container_active_img">   
                              
                            <img src="{{asset("Photos/".$videoGame->photoList()->first()->url())}}" alt="" class="game_detail_active_img">

                            <div class="active_img_open">
                                <img src="{{ asset('/img/icon/icon-search.svg')}}" alt="" class="icon_active_img_open">
                            </div>
    
                        </div>
                        
                    </div>

                    

                    <div class="container_detail_game_content_price">
                        @include('jeuVideo/form_Favori')
                        <div class="detail_game_price">
                            <div class="detail_game_pricee_first_value">
                
                                {{ $videoGame->prixTTCeuro() }}
                            </div>
                
                
                            <div class="detail_game_price_second_value">
                
                                €{{ $videoGame->prixTTCcentime() }}
                            </div>
                        </div>
    
                        <div class="detail_game_stock">
    
                            @if ($videoGame->jeu_stock > 0)
                                <p class="game_line_in_stock" > <i class="fas fa-check-circle icon_game_line"></i> En stock </p>
                            @else
                                <p class="game_line_out_of_stock" > <i class="fas fa-times-circle icon_game_line"></i> Rupture de stock </p>
                            @endif
    
                        </div>
    
                        @include('jeuVideo.form_Panier')


                        <div class="detail_game_comparator_container">
                            <div onclick="addToSession()" class="comparator_add">
                                <input type="hidden" name="key" value="comparateur" id="session_key">
                                <input type="hidden" name="value" id="session_value" value="{{$videoGame->id_jeu()}}">
                                <i class="fas fa-plus"></i>
                            </div>
                            <a href="{{route("comparateur")}}">
                                <div class="comparator_link">
                                    Accéder au comparateur
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
    
    
                <div class="container_detail_game_content_spec_descr">
                    <div class="container_detail_game_content_spec">
                        <div class="container_detail_game_content_spec_tab">
                            <div class="detail_game_spec">
                                <h5 class="detail_game_spec_title">Détails produits</h5>
                            </div>
                            <div class="detail_game_spec_line_infos">
                                <p class="spec_line_info_type">Plateforme</p>
                                <a href="#" class="spec_line_info_link"> {{ $videoGame->console->con_nom }} </a>
                            </div>
        
                            <div class="detail_game_spec_line_infos">
                                <p class="spec_line_info_type">Editeur</p>
                                <a href="#" class="spec_line_info_link"> {{ $videoGame->editeur->edi_nom }} </a>
                            </div>
        
                            <div class="detail_game_spec_line_infos">
                                <p class="spec_line_info_type">Date de parution</p>
                                <p class="spec_line_info_txt"> {{ $videoGame->jeu_dateparution->translatedFormat('F Y ') }} </p>
                            </div>
        
                            <div class="detail_game_spec_line_infos">
                                <p class="spec_line_info_type">Public légal</p>
                                <p class="spec_line_info_txt"> {{ $videoGame->jeu_publiclegal }} </p>
                            </div>
                        </div>
                    </div>
    
                    <div class="container_detail_game_content_descr">
                        <div class="detail_game_descr">
                            <h4 class="detail_game_descr_title">Description</h4>
                            <p class="detail_game_descr_txt">
                                {{ $videoGame->jeu_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @include('jeuVideo.avis.displayAll')
        </div>



        <div class="container_lightbox_detail_game">
            <div class="lightbox_detail_game_content">
                <div class="lightbox_detail_game_close">
                    <div class="lightbox_detail_game_close_sub_container">

                    </div>
                </div>
                <img src="" alt="" class="lightbox_detail_game_img">
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
    <script src="{{ asset("js/content/content-videoGame-detail.js") }}"></script>
    <script src="{{ asset("js/avis/avis_note_display.js") }}"></script>
@endsection