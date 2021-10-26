<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Commande;
use Illuminate\Support\Facades\Hash;

class CommandeController extends Controller
{

    public function commandeVeille() {
        $date = date('Y-m-d',strtotime("-1 days"));
        //dd($date);
        /*$now = new Date();
        $now->add('-1 days');*/
       
        
        $allCmd = Commande::where('com_date', $date)->get();
       
        return view("serviceClient.commandeVeille/displayAll", [ 'allCommande'=>$allCmd ]) ;
    }

}
