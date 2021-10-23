<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Editeur;
use App\Models\JeuVideo;
use App\Models\MotCle;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class jeuVideoController extends Controller
{

    public static $nb = 0;

    /**
     * Show the home page of the Fnac webSite
     *
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
       
        return view ("jeuVideo.displayAllLines", ['videoGames'=>JeuVideo::all()]);
    }



    /**
     * Show the video games of a selected shelf 
     *
     * @param  int  $id 
     * @return \Illuminate\View\View
     */
    public function searchByRayon($id)
    {
        $allVideoGames = JeuVideo::all();
        $currentRay = Rayon::find($id);
        $videoGames = [];
        foreach($allVideoGames as $videoGame)
        {
            foreach($videoGame->rayons as $rayon)
            {
                if($id == $rayon->ray_id)
                    $videoGames[] = $videoGame;
            }
        }

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames, 'currentRay' => $currentRay]);
    }

    /**
     * Show the video games of a selected console
     *
     * @param  int  $id 
     * @return \Illuminate\View\View
     */
    public function searchByConsole($id)
    {
        $allVideoGames = JeuVideo::all();
        $videoGames = [];
        foreach($allVideoGames as $videoGame)
        {
            if($id == $videoGame->console->con_id)
                $videoGames[] = $videoGame;
        }

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames]);
    }

    /**
     * Show the profile for a given user.
     *
     *
     * @return \Illuminate\View\View
     */
    public function detailVideoGame($idGame)
    {
        try {
            $videoGameSelected = JeuVideo::findOrFail($idGame);
        }
        catch (Throwable $e) {
            abort(404, "$e");
        }
        
        $client = Auth::user();
        $boughtThisGame = false;
        if($client)
        {
            $boughtThisGame = $client->boughtThisGame($idGame);
        }

        return view ("jeuVideo.displayDetail", [
            'videoGame'=> $videoGameSelected,
            'client' => Auth::user(),
            'boughtThisGame' => $boughtThisGame
        ]);
    }

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
        
        //dd(session("panier"));
        return redirect()->route('panier');

    }

    public function panier(){
        //session()->forget('panier');
        $panier = session("panier");
        $jeuInPanier = [];
        foreach($panier as $idGame => $qte)
        {
            $jeuInPanier[] = ['jeu' => JeuVideo::find($idGame),'qte'=> $qte];
        }
        return view ("jeuVideo.panier", [ 'jeuInPanier' => $jeuInPanier]);

    }


    
    public function rechercheJeu(Request $request)
    {
        if($request->barreRecherche != ""){
            if(MotCle::findMot($request->barreRecherche)){
                $jeux = JeuVideo::jeuxMotCle($request->barreRecherche);
            }
            else{
                $jeux = JeuVideo::chercheJeu($request->barreRecherche);
            }
            return view("jeuVideo.displayAllLines", ['videoGames'=>$jeux]);
        }
        else{
            return redirect()->route("home");
        }
    }
    public function comparateur() {
        $statsJeux = array();
        //Populate statsJeux if items in comparator
        if(session()->has('comparateur')) {
            //Test if all games in session exists
            foreach(session('comparateur') as $idJeu) {
                $jeu = JeuVideo::find($idJeu);
                if($jeu) $jeux[]=$jeu;
                else return redirect()->route('home');
            }
            //Calculates stats for each game
            foreach($jeux as $jeu) {
                $statsJeux[$jeu->id_jeu()] = array(
                    "Nom" => $jeu->nom(),
                    "PrixTTC" => $jeu->prixTTC(),
                    "Stock" => $jeu->stock(),
                    "Age légal" => $jeu->publicLegal(),
                    "Date de parution" => $jeu->dateParution(),
                    "Note moyenne" => $jeu->avis()->avg('avi_note'),
                    "Nombre de ventes" => $jeu->ligneCommande()->sum('lec_quantite'),
                    "Nombre de favoris" => $jeu->favori()->count(),
                    "Editeur" => Editeur::find($jeu->edi_id)->nom(),
                );
            }
            
        }
        $statsList = array("Nom", "PrixTTC", "Stock", "Age légal", "Date de parution", "Note moyenne", "Nombre de ventes", "Nombre de favoris", "Editeur");
        return view("jeuVideo.comparateur", ['statsJeux'=>$statsJeux, 'statsList'=>$statsList]);
    }
}
