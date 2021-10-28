<div class="contentComm_line_container">

    <img src="{{asset("Photos/".$aLigneCommande->jeuvideo->photoList()->first()->url())}}" alt="" class="contentComm_line_img">
     
     <p class="contentComm_line_name" >{{ $aLigneCommande->jeuvideo->jeu_nom }}</p>

     <div class="contentComm_line_price">
         <div class="contentComm_line_price_first_value">
             {{ $aLigneCommande->jeuvideo->prixTTCeuro() }}
         </div>


         <div class="contentComm_line_price_second_value">
             €{{ $aLigneCommande->jeuvideo->prixTTCcentime() }}
             
         </div>
     </div>                        
 </div>