<?php

namespace App\Http\Controllers;

use App\Models\JeuVideo;
use App\Models\Rayon;
use App\Models\Console;
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
        return view ("jeuVideo.displayAllLines", ['videoGames'=>JeuVideo::all(), 'rayons' => Rayon::all(), 'consoles'=>Console::all() ]);
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

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames , 'rayons' => Rayon::all(), 'currentRay' => $currentRay, 'consoles'=>Console::all() ]);
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

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames , 'rayons' => Rayon::all(), 'consoles'=>Console::all()]);
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
            'rayons' => Rayon::all(),
            'consoles'=>Console::all()
        ]);
    }
}
