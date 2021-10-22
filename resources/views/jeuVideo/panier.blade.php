

<div class="container_contentComm">
    <h4 class="contentComm_title">Contenu :</h4>

    <div class="container_contentComm_content">


        @foreach ($jeuInPanier as $aLignePanier)

            
            <div class="contentComm_line_container">

                @php
                    $displayFirstImage = false;
                @endphp

                @foreach ($aLignePanier['jeu']->photo as $photo)

                    @if (!$displayFirstImage)
                        <img src="{{asset("Photos/".$photo->pho_url)}}" alt="" class="contentComm_line_img">

                        @php $displayFirstImage = true; @endphp
                    @endif
                
                @endforeach
                
                <p class="contentComm_line_name" >{{ $aLignePanier['jeu']->jeu_nom }}</p>

                <div class="contentComm_line_price">
                    <div class="contentComm_line_price_first_value">
                        {{ $aLignePanier['jeu']->prixTTCeuro() }}
                    </div>
        
        
                    <div class="contentComm_line_price_second_value">
                        €{{ $aLignePanier['jeu']->prixTTCcentime() }}
                        
                    </div>
                </div>

                <h1>QTE : {{$aLignePanier['qte']}}</h1>

            </div>

            
        @endforeach



    </div>


    

</div>