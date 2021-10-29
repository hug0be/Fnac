<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Commande;
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
        $myCommandes = Commande::where('cli_id', Auth::user()->id())->get();
       
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

}
