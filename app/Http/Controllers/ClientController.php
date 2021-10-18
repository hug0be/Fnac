<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function profile() {
        $client = Auth::user();
        if($client)
            return view("profile", ['rayons'=>Rayon::all(),'compte'=>$client]);
        else
            return redirect()->route("login");
    }

    public function editAccount(Request $request) {
        $validated = $request->validate([
            'cli_id' => ['required', 'exists:t_e_client_cli,cli_id'],
            'civilité' =>  ['required', Rule::in(['M','Mme','Mlle'])],
            'email' => ['required','email','max:80'],
            'nom' =>['required','alpha','max:50'],
            'prenom'=>['required','alpha','max:50'],
            'pseudo'=>['required','max:20'],
            'portable'=>['nullable','required_without:fixe','regex:/^[0-9]{10}$/'],
            'fixe'=>['nullable','required_without:portable','regex:/^[0-9]{10}$/']
        ]);
        $client = Client::find($request->cli_id);
        $client->cli_civilite = $request->civilité;
        $client->cli_nom = $request->nom;
        $client->cli_prenom = $request->prenom;
        $client->cli_pseudo = $request->pseudo;
        $client->cli_mel = $request->email;
        $client->cli_telportable = $request->portable;
        $client->cli_telfixe = $request->fixe;
        $client->save();
        return back();
    }

    public function password() {
        $id_client = Auth::user()->id_client();
        return view("password", ['id_client'=>$id_client, 'rayons'=>Rayon::all()]);
    }
    public function changePassword(Request $request) {
        $validated = $request->validate([
            'cli_id' => ['required', 'exists:t_e_client_cli,cli_id'],
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8','confirmed'],
        ]);
        $client = Client::find($request->cli_id);
        $client->cli_motpasse = Hash::make($request->new_password);
        $client->save();
        return back();
    }
}
