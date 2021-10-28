<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriController extends Controller
{
    public function toggle_favori(Request $request)
    {
        $idUser = Auth::user()->id();
        $jeufavori = Favori::where('cli_id', $idUser)
                        ->where('jeu_id', $request->jeuId)
                        ->first();
        if($jeufavori)
            $jeufavori->delete();
        else {
            $jeufavori = new Favori();
            $jeufavori->jeu_id = $request->jeuId;
            $jeufavori->cli_id = $idUser;
            $jeufavori->save();
        }
        return redirect()->back();
    }

    /**
     * Show the home page of the Fnac webSite
     *
     *
     * @return \Illuminate\View\View
     */
    public function favoritesGames()
    {  
        return view ("jeuVideo.displayAllLines", ['videoGames'=>Auth::user()->jeuFavoris]);
    }
}
