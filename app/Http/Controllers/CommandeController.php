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
       
        
        $allCmd = Commande::where('com_date', $date)->orderBy('com_date', 'desc')->get();
       
        return view("serviceClient.commandesVeille", [ 'allCommande'=>$allCmd ]) ;
    }

    public function myCommandes() {

        $myCommandes = Commande::where('cli_id', Auth::user()->id())->orderBy('com_date', 'desc')->orderBy('com_id', 'desc')->get();
        return view("client.mesCommandes", [ 'allCommande'=>$myCommandes, 'textEnCours'=>''  ]) ;
    }

    public function myCommandesEnCours() {
        $myCommandes = Commande::where('cli_id', Auth::user()->id())->get();
        foreach($myCommandes as $comKey => $comVal){
            if(!$comVal->isEnCours()){
                unset($myCommandes[$comKey]);
            }
        }
        return view("client.mesCommandes", [ 'allCommande'=>$myCommandes, 'textEnCours'=>' en cours' ]) ;
    }
    
    public function passerCommande() {

        $adresseList = Auth::user()->adresseList->where('adr_type', 'Livraison');
        $relayList = Relais::all();

        $magasinList = Magasin::all();
        return view("commande.passerCommande.passerCommande", [ 'adresseList'=> $adresseList, 'relayList' => $relayList,
        'magasinList' =>$magasinList ]) ;
    }

    public function createCommande(Request $request)
    {
        $commande= new Commande();
        if($request->typeDelivery == 'adr'){
            $request->validate([
                'adr_id' => 'required',
              ],[
                'adr_id.required' => 'Il faut que vous choisissiez une adresse',
            ]);
            $commande->adr_id = $request->adr_id;
        }
        else if($request->typeDelivery == 'rel') {
            $request->validate([
                'rel_id' =>  'required'
            ], [
                'rel_id.required' => 'Il faut que vous choisissiez un relais',
            ]);
            $commande->rel_id = $request->rel_id;
        }
        else if($request->typeDelivery == 'mag') {
            $request->validate([
                'mag_id' =>  'required'
            ], [
                'mag_id.required' => 'Il faut que vous choisissiez un magasin',
            ]);
            $commande->mag_id = $request->mag_id;
        } else
        {
            $request->validate([
                'typeDelivery' =>  'required'
            ], [
                'typeDelivery.required' => 'Veuillez selectionner un type de livraison',
            ]);
        }
        $commande->cli_id = Auth::user()->cli_id;
        $commande->com_date = date('Y-m-d');

        
        
        $commande->save();
        $this->createLignesCommande(session('panier'), $commande->id());
        session()->put("panier", []);
        return redirect()->route('myCommandes')->withInput(["validation"=>"Commande Réussie"]);
    }

    private function createLignesCommande($panier, $com_id)
	{
		foreach($panier as $idGame => $qte)
        {
			$ligneCommande = new LigneCommande();
            $ligneCommande->jeu_id = $idGame;
            $ligneCommande->lec_quantite = $qte;
            $ligneCommande->com_id = $com_id;
            $ligneCommande->save();
        }
		
	}



}
