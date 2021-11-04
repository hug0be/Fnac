<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Client;
use App\Models\Pays;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    // public function detailAccount() {
    //     return view("client.detailAccount", [ 'detailsAccount'=> Auth::user() ]);
    // }

    public function profile() {
        return view("client.profile", ['compte'=>Auth::user()]);
    }

    public function editAccount(Request $request) {
        $request->validate([
            'civilité' =>  ['required', Rule::in(['M','Mme','Mlle'])],
            'email' => ['required','email','max:80',Rule::unique('t_e_client_cli','cli_mel')->ignore(Auth::id(), 'cli_id')],
            'nom' =>['required','alpha','max:50'],
            'prenom'=>['required','alpha','max:50'],
            'pseudo'=>['required','max:20'],
            'portable'=>['nullable','required_without:fixe','regex:/^[0-9]{10}$/'],
            'fixe'=>['nullable','required_without:portable','regex:/^[0-9]{10}$/']
        ]);
        $client = Client::find(Auth::id());
        $client->cli_civilite = $request->civilité;
        $client->cli_nom = $request->nom;
        $client->cli_prenom = $request->prenom;
        $client->cli_pseudo = $request->pseudo;
        $client->cli_mel = $request->email;
        $client->cli_telportable = $request->portable;
        $client->cli_telfixe = $request->fixe;
        $client->save();
        return back()->withInput(['validation'=>'Votre compte a bien été modifié !']);
    }
    public function password() {
        return view("client.password");
    }
    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8','confirmed'],
        ]);
        $client = Client::find(Auth::id());
        $client->cli_motpasse = Hash::make($request->new_password);
        $client->save();
        return back();
    }

    public function newAdresse() {
        return view("client.adresse.newAdresse", ['compte'=>Auth::user(), 'paysList' => Pays::all()]);
    }
    
    public function createAdresse(Request $request)
    {
        $validated = $request->validate([
            'adr_nom' => 'required',
            'adr_type' => 'required',
            'adr_rue' => 'required',
            'adr_cp' => 'required',
            'adr_ville' => 'required',
            'pay_id' => 'required',
        ]);
        Adresse::create([
            'cli_id'=> Auth::guard('client')->user()->id(),
            'adr_nom'=> $request->adr_nom,
            'adr_type'=> $request->adr_type,
            'adr_rue'=> $request->adr_rue,
            'adr_cp'=> $request->adr_cp,
            'adr_ville'=> $request->adr_ville,
            'pay_id'=> $request->pay_id,
            'adr_complementrue'=> $request->adr_complementrue,
        ]);
        return redirect()->route('cli.profile');
    }
    
    public function myAdresses()
    {
        return view("client.adresse.displayAll", ['adressList'=>Auth::user()->adresseList]);
    }
}
