<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\AvisAbusif;
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
        return view ("jeuVideo.displayAllLines", ['videoGames'=>JeuVideo::all(), 'consoles'=>Console::all() ]);
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

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames, 'currentRay' => $currentRay, 'consoles'=>Console::all() ]);
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

        return view ("jeuVideo.displayAllLines", ['videoGames'=> $videoGames, 'consoles'=>Console::all()]);
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
            'consoles'=>Console::all()
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
            'consoles'=>Console::all()

        ]);
    }

    /**
     * Delete an abusifAvis
     *
     * @return \Illuminate\View\View
     */
    public function delete_avis(Request $request)
    {
        $avisAbusifList = AvisAbusif::where('avi_id', $request->id_avis)->get();
        $avis = $avisAbusifList[0]->avis;
        foreach($avisAbusifList as $avisAbusif)
        {
            $avisAbusif->delete();
        }
        $avis->delete();
        return redirect()->route('avisAbusifs');
        
    }

    
}
