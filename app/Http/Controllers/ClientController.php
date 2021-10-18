<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller {


    public function detailAccount() {
        return view( "client.detailAccount", [ 'detailsAccount'=> Client::find(Auth::id()), 'rayons'=>Rayon::all()] );
    }

}