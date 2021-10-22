@extends('base')


@section('css')
    <link rel="stylesheet" href="{{ asset("css/sideBar/sideBar-videoGame-detail.css") }}">
    <link rel="stylesheet" href="{{ asset("css/serviceClient/commandeVeille.css") }}">


@endsection


@section('header')
    @include('layout.header-videoGame-detail')

@endsection


@section('content')

    @include('layout.menu')

    <div class="container_all_commande margin_top_content">




        <h1 class="commande_title_serv_client">Service Client</h1>


        <div class="container_all_commande_content">

            <h1 class="commande_title">Commandes passées la veille :</h1>

            @foreach ($allCommande as $aCommande)
                {{-- <p>{{ $aCommande->com_date}}</p>
                <p>{{ $aCommande}}</p>
                <p>{{ $aCommande->magasin}}</p> --}}



                <div class="container_one_commande">

                    <div class="one_commande_title_container">
                        <h2 class="one_commande_title">Commande N° {{ $aCommande->com_id }} </h2>
                        <span class="one_commande_date">{{ $aCommande->com_date->translatedFormat(' j M Y') }}</span>

                    </div>

                    <div class="container_infoComm_contentComm">

                        <div class="container_infoComm">
                            <h4 class="infoComm_title">Informations :</h4>

                            <div class="container_infoComm_content">

                                <div class="infoComm_content_customer">
                                    <h5 class="infoComm_content_customer_title">
                                        Client
                                    </h5>

                                    <div class="infoComm_content_customer_content">
                                        <div class="infoComm_content_box">
                                            <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Nom :</span>  {{ $aCommande->client->cli_nom }} </p>
                                        </div>
    
                                        <div class="infoComm_content_box">
                                            <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Prénom :</span>  {{ $aCommande->client->cli_prenom }} </p>
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="infoComm_content_delivery">
                                    <h5 class="infoComm_content_delivery_title">
                                        Livraison : {{ $aCommande->typeDelivery() }}
                                    </h5>

                                   

                                    <div class="infoComm_content_delivery_content">

                                        @if ($aCommande->isDeliveryRelay())

                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Nom :</span>  {{ $aCommande->relais->rel_nom }} </p>
                                            </div>
        
                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Rue :</span>  {{ $aCommande->relais->rel_rue }} </p>
                                            </div>

                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">CP :</span>  {{ $aCommande->relais->rel_cp }} </p>
                                            </div>

                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Ville :</span>  {{ $aCommande->relais->rel_ville }} </p>
                                            </div>

                                        @endif

                                        @if ($aCommande->isDeliveryHouse())

                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Rue :</span>  {{ $aCommande->adresse->adr_rue }} </p>
                                            </div>
        
                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">CP :</span>  {{ $aCommande->adresse->adr_cp }} </p>
                                            </div>

                                            <div class="infoComm_content_box">
                                                <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Ville :</span>  {{ $aCommande->adresse->adr_ville }} </p>
                                            </div>

                                        @endif

                                        @if ($aCommande->isDeliveryStore())

                                        <div class="infoComm_content_box">
                                            <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Nom :</span>  {{ $aCommande->magasin->mag_nom }} </p>
                                        </div>
    
                                        <div class="infoComm_content_box">
                                            <p class="infoComm_content_txt"> <span class="infoComm_content_txt_type">Ville :</span>  {{ $aCommande->magasin->mag_ville }} </p>
                                        </div>

                                    @endif

                                        


                                        
                                    </div>
                                   
                                </div>






                                {{-- <div class="infoComm_content_box">
                                    <p class="infoComm_content_txt"><span class="infoComm_content_txt_type">Adresse :</span> {{ $aCommande->magasin }}</p>
                                </div> --}}

                                {{-- <img src="{{asset("Photos/".$photo->pho_url)}}" alt="" class="game_line_img"> --}}

                            </div>

                        </div>

                        <div class="container_contentComm">
                            <h4 class="contentComm_title">Contenu :</h4>

                            <div class="container_contentComm_content">


                                @foreach ($aCommande->ligneCommandeList as $aLigneCommande)

                                    <div class="contentComm_line_container">

                                        @php
                                            $displayFirstImage = false;
                                        @endphp
    
                                        @foreach ($aLigneCommande->jeuvideo->photo as $photo)
    
                                            @if (!$displayFirstImage)
                                                <img src="{{asset("Photos/".$photo->pho_url)}}" alt="" class="contentComm_line_img">
    
                                                @php $displayFirstImage = true; @endphp
                                            @endif
                                        
                                        @endforeach
                                        
                                        <p class="contentComm_line_name" >{{ $aLigneCommande->jeuvideo->jeu_nom }}</p>

                                        <div class="contentComm_line_price">
                                            <div class="contentComm_line_price_first_value">
                                                @php
                                                    $game_line_price_first_value = substr($aLigneCommande->jeuvideo->jeu_prixttc, 0, 2);
                                                @endphp
                                
                                                {{ $game_line_price_first_value }}
                                            </div>
                                
                                
                                            <div class="contentComm_line_price_second_value">
                                                @php
                                                    $game_line_price_second_value = substr($aLigneCommande->jeuvideo->jeu_prixttc, 3);
                                                @endphp
                                
                                                €{{ $game_line_price_second_value }}
                                                
                                            </div>
                                        </div>
    
    
                                        
                                    </div>

                                    
                                @endforeach



                            </div>


                            <div class="contentComm_total">
                                <p> {{ $aCommande->totalOrder() }} </p>
                            </div>

                        </div>

                    </div>

                </div>


            @endforeach






        </div>


    </div>




@endsection











@section('js')
    <script src="{{ asset("js/sideBar-toggle/sideBar-videoGame-detail.js") }}"></script>
    <script src="{{ asset("js/content/content-videoGame-detail.js") }}"></script>
@endsection