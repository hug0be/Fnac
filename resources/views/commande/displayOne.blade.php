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
                        Livraison : {{ $aCommande->typeDelivery() }} - {{ $aCommande->displayEtat() }}
                    </h5>

                   

                    <div class="infoComm_content_delivery_content">

                        @if ($aCommande->isDeliveryRelay())
                        @include('commande.typeLivraison.displayRelay')
                        @endif
                        
                        @if ($aCommande->isDeliveryHouse())
                        @include('commande.typeLivraison.displayHouse')
                        @endif
                        
                        @if ($aCommande->isDeliveryStore())
                        @include('commande.typeLivraison.displayStore')
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
                    @include('commande.ligneCommande.displayOneShort')                    
                @endforeach
            </div>

            <div class="contentComm_total">
                <p>{{ $aCommande->totalOrderEuro() }}€{{ $aCommande->totalOrderCentime() }} </p>
            </div>

        </div>

    </div>

</div>