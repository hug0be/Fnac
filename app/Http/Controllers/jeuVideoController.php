<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Editeur;
use App\Models\JeuVideo;
use App\Models\MotCle;
use App\Models\Photo;
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
     * Display the detail of a video game selected
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


    /**
     * Method to display the result of a research
     * 
     * @return \Illuminate\View\View or redirect to home
     */
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

     /**
     * Method to display the comparator
     * 
     * @return \Illuminate\View\View
     */
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
                    'Image' => $jeu->photoList()->first()->url(),
                    'Nom' => $jeu->nom(),
                    "PrixTTC" => $jeu->prixTTC(),
                    "Disponibilité" => ($jeu->stock() > 0),
                    "Age légal" => $jeu->publicLegal(),
                    "Date de parution" => $jeu->dateParution(),
                    "Note moyenne" => $jeu->avisList()->avg('avi_note'),
                    "Nombre de ventes" => $jeu->ligneCommandeList()->sum('lec_quantite'),
                    "Nombre de favoris" => $jeu->favoriList()->count(),
                    "Editeur" => Editeur::find($jeu->edi_id)->nom(),
                );
            }
        }
        //List of stats that will be compared
        $statsList = array("PrixTTC", "Disponibilité", "Age légal", "Date de parution", "Note moyenne", "Nombre de ventes", "Nombre de favoris", "Editeur");
        return view("jeuVideo.comparateur", ['games'=>$statsJeux, 'stats'=>$statsList]);
    }
}
