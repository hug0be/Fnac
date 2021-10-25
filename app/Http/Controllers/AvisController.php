<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\AvisAbusif;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Show the avis maked as abusifs
     *
     *
     * @return \Illuminate\View\View
     */
    public function avisAbusifs()
    {
        $avisAbusifList = AvisAbusif::all();

        $nbAvisAbusifByIdList = [];
        foreach($avisAbusifList as $key=>$avisAbusif)
        {
            if(array_key_exists($avisAbusif->avi_id, $nbAvisAbusifByIdList)) {
                unset($avisAbusifList[$key]);
                $nbAvisAbusifByIdList[$avisAbusif->avi_id]++;
            }
            else
                $nbAvisAbusifByIdList[$avisAbusif->avi_id] = 1;
        }
        return view ("serviceComm.avisAbusifs", [
            'avisAbusifs' => $avisAbusifList,
            'nbAvisAbusifByIdList' => $nbAvisAbusifByIdList,
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

     /**
     * Delete an abusifAvis
     *
     * @return \Illuminate\View\View
     */
    public function addAvis(Request $request)
    {
        $request->validate([
            'avi_note' => 'required|min:1|max:5',
            'avi_titre' => 'required',
            'avi_detail' => 'required',
          ],
        [
            'avi_note.required' => 'Il faut que vous précisez une note.',
            'avi_note.min' => 'La note doit être au minimum à 1',
            'avi_note.maximum' => 'La note doit être au maximum à 5',
            'avi_detail.required' => 'Il faut que vous entrez un avis.',
            'avi_titre.required' => 'Il faut que vous doniez un titre a votre avis.',
        ]);
        $client = Client::find(Auth::user()->cli_id);
        
        $avis = new Avis();
        $avis->cli_id = $client->id();
        $avis->jeu_id = $request->jeu_id;
        $avis->avi_date = date("Y-m-d");
        $avis->avi_titre = $request->avi_titre;
        $avis->avi_detail = $request->avi_detail;
        $avis->avi_note = $request->avi_note;
        $avis->avi_nbutilenon = 0;
        $avis->avi_nbutileoui = 0;

        $avis->save();

        return redirect()->route('detailVideoGame', ['idGame'=> $request->jeu_id]);
        
    }


    /**
     * Increment nb avisUtile
     *
     * @return \Illuminate\View\View
     */
    public function add_avisUtile(Request $request)
    {
        $avis = Avis::find($request->avisId);

        $avis->avi_nbutileoui++;

        $avis->save();

        return redirect()->route('detailVideoGame', ['idGame'=> $avis->jeuvideo->id_jeu()]);
        
    }

    /**
     * Increment nb avisInutile
     *
     * @return \Illuminate\View\View
     */
    public function add_avisInutile(Request $request)
    {
        $avis = Avis::find($request->avisId);

        $avis->avi_nbutilenon++;

        $avis->save();

        return redirect()->route('detailVideoGame', ['idGame'=> $avis->jeuvideo->id_jeu()]);
        
    }

    /**
     * Increment nb avisInutile
     *
     * @return \Illuminate\View\View
     */
    public function add_avisAbusif(Request $request)
    {
        $avis = Avis::find($request->avisId);
        $avisAbusif = new AvisAbusif();
        $avisAbusif->cli_id = Auth::user()->cli_id;
        $avisAbusif->avi_id = $avis->id();

        $avisAbusif->save();

        return redirect()->route('detailVideoGame', ['idGame'=> $avis->jeuvideo->id_jeu()]);
        
    }
}
