<?php

namespace App\Http\Controllers;

use App\Models\AvisAbusif;
use App\Models\JeuVideo;
use App\Models\Rayon;
use Illuminate\Http\Request;

class jeuVideoController extends Controller
{

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
        $videoGameSelected = JeuVideo::find($idGame);
        return view ("jeuVideo.displayDetail", [
            'videoGame'=> $videoGameSelected,
        ]);
    }


    /**
     * Show the avis maked as abusifs
     *
     *
     * @return \Illuminate\View\View
     */
    public function avisAbusifs()
    {
        $avisAbusifList = AvisAbusif::all();

        $idAvisList = [];
        foreach($avisAbusifList as $key=>$avisAbusif)
        {
            if(in_array($avisAbusif->avi_id, $idAvisList))
                unset($avisAbusifList[$key]);
            else
                $idAvisList[] = $avisAbusif->avi_id;
        }
        return view ("serviceComm.avisAbusifs", [
            'avisAbusifs' => $avisAbusifList,

        ]);
    }

    /**
     * Delete an abusifAvis
     *
     * @return \Illuminate\View\View
     */
    public function delete_avis(Request $request) {
        $avisAbusifList = AvisAbusif::where('avi_id', $request->id_avis)->get();
        $avis = $avisAbusifList[0]->avis;
        foreach($avisAbusifList as $avisAbusif) {
            $avisAbusif->delete();
        }
        $avis->delete();
        return redirect()->route('avisAbusifs');
    }

    public function comparateur(Request $request) {
        $request->session()->forget('comparateur');
        $request->session()->push('comparateur', 1);
        $request->session()->push('comparateur', 2);
        //$request->session()->all()
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
                "Nombre de favoris" => $jeu->favori()->count()
            );
        }
        $statsList = array("Nom", "PrixTTC", "Stock", "Age légal", "Date de parution", "Note moyenne", "Nombre de ventes", "Nombre de favoris");
        return view("jeuVideo.comparateur", ['session'=> session('comparateur'), 'statsJeux'=>$statsJeux, 'statsList'=>$statsList]);
    }
}
