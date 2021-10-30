<div class="contentComm_line_container">
    <a href="{{route("detailVideoGame", ['idGame' => $aLigneCommande->jeuvideo->id()])}}">
        <img src="{{asset("Photos/".$aLigneCommande->jeuvideo->photoList()->first()->url())}}" alt="" class="contentComm_line_img">
    </a>    
    <a href="{{route("detailVideoGame", ['idGame' => $aLigneCommande->jeuvideo->id()])}}">
        
        <p class="contentComm_line_name" >{{ $aLigneCommande->jeuvideo->jeu_nom }}</p>
    </a>

     <div class="contentComm_line_price">
         <div class="contentComm_line_price_first_value">
             {{ $aLigneCommande->jeuvideo->prixTTCeuro() }}
         </div>


         <div class="contentComm_line_price_second_value">
             €{{ $aLigneCommande->jeuvideo->prixTTCcentime() }}
         </div>
         <div class="contentComm_line_price_first_value">  X {{$aLigneCommande->quantite()}}</div>
     </div>                        
 </div>