<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Commande;
use Illuminate\Support\Facades\Hash;

class CommandeController extends Controller
{

    public function commandeVeille() {
        return view("serviceClient.commandeVeille/displayAll", [ 'allCommande'=> Commande::all() ]) ;
    }

}
