<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\JeuVideo;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class PanierController extends Controller
{
    /**
     * Methode to add a video game to the cart
     * 
     * @return redirect to the cart page
     */
    public function addPanier(Request $request){
        //session()->forget('panier');
        $panier = session("panier");
        if(isset($panier[$request->idJeu]))
        {
            $panier[$request->idJeu]++;
        } else {
            $panier[$request->idJeu] = 1;
        }
        session()->put("panier", $panier);

        return redirect()->route('panier');

        

    }

    /**
     * Method to display the content of the cart
     * 
     * @return \Illuminate\View\View
     */
    public function panier(){
        //session()->forget('panier');
        $panier = session("panier") ?? [];

        $jeuInPanier = [];
        $total = 0;
        foreach($panier as $idGame => $qte)
        {
            $jeu = JeuVideo::find($idGame);
            $total += $jeu->prixTTC() * $qte;
            $jeuInPanier[] = ['jeu' => $jeu,'qte'=> $qte]; 

        }

        return view ("jeuVideo.panier", [ 'jeuInPanier' => $jeuInPanier, 'total' => $total]);

    }

    /**
     * Method decrement the quantity of a video game in the cart
     * 
     * @return redirect to the cart page
     */
    public function decrement_qte_panier(Request $request){
        //session()->forget('panier');
        $panier = session("panier");
        if(isset($panier[$request->idJeu]))
        {
            if($panier[$request->idJeu] > 1)
                $panier[$request->idJeu]--;

            else unset($panier[$request->idJeu]);
        }
        session()->put("panier", $panier);
        
        return redirect()->route('panier');

    }
}
