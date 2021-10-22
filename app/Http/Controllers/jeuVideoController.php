<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\JeuVideo;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $videoGameSelected = JeuVideo::find($idGame);
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


}
