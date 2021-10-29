<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Magasin;
use App\Models\Relais;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommandeController extends Controller
{

    public function commandeVeille() {
        $date = date('Y-m-d',strtotime("-1 days"));
       
        
        $allCmd = Commande::where('com_date', $date)->get();
       
        return view("serviceClient.commandesVeille", [ 'allCommande'=>$allCmd ]) ;
    }

    public function myCommandes() {        
       
        return view("client.mesCommandes", [ ]);
    }
    
    
    public function passerCommande() {

        $adresseList = Auth::user()->adresseList->where('adr_type', 'Livraison');
        $relayList = Relais::all();

        $magasinList = Magasin::all();
        return view("commande.passerCommande.passerCommande", [ 'adresseList'=> $adresseList, 'relayList' => $relayList,
        'magasinList' =>$magasinList ]) ;
    }

    public function addCommande(Request $request)
    {
        $request->validate([
            'rel_id' => 'required_without_all:mag_id,adr_id',
            'mag_id' => 'required_without_all:rel_id,adr_id',
            'adr_id' => 'required_without_all:mag_id,rel_id',
          ],
        [
        ]);
        dd("Form validé !");
        $commande= new Commande();
        $commande->cli_id = Auth::user()->cli_id;
        $commande->com_date = date('Y-m-d');
        $commande->save();
        $this->panierToCommande(session('panier'), Auth::user()->cli_id);
    }

    private function panierToCommande($panier, $cli_id)
	{
		$commande = Commande::where('cli_id', $cli_id);
		// dd($panier);
		foreach($panier as $idGame => $qte)
        {
            
			$ligneCommande = new LigneCommande();
            $ligneCommande->
            $jeu->prixTTC() * $qte;
            $jeuInPanier[] = ['jeu' => $jeu,'qte'=> $qte]; 

        }
		return $commande;
	}



}
