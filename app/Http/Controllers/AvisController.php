<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\AvisAbusif;
use Illuminate\Http\Request;

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
        $avis = new Avis();
        $avis->cli_id = 1;
        $avis->jeu_id = $request->jeu_id;
        $avis->avi_date = date("Y-m-d");
        $avis->avi_titre = $request->avi_titre;
        $avis->avi_detail = $request->avi_detail;
        $avis->avi_note = $request->avi_note;
        $avis->avi_nbutilenon = 0;
        $avis->avi_nbutileoui = 0;

        $avis->save();

        return redirect()->route('detailVideoGame', ['idGame'=> 1]);
        
    }
}
