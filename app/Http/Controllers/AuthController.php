<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rayon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller {
    public function login() {
        return view ("login", ['rayons'=>Rayon::all()]);
    }
    public function logout() {
        Auth::logout();
        return redirect()->route("home");
    }
    public function register() {
        return view ("register", ['rayons'=>Rayon::all()]);
    }
    public function createAccount(Request $request) {
        $validated = $request->validate([
            'cli_civilite' =>  ['required', Rule::in(['M','Mme','Mlle'])],
            'cli_mel' => ['required','email','max:80','unique:t_e_client_cli'],
            'cli_motpasse' => ['required', 'min:8','confirmed'],
            'cli_nom' =>['required','alpha','max:50'],
            'cli_prenom'=>['required','alpha','max:50'],
            'cli_pseudo'=>['required','max:20'],
            'cli_telportable'=>['required_without:cli_telfixe'],
            'cli_telfixe'=>['required_without:cli_telportable']
        ]);
        $client = Client::create([
            'cli_civilite' => $request->cli_civilite,
            'cli_mel'=> $request->cli_mel,
            'cli_nom' => $request->cli_nom,
            'cli_prenom' => $request->cli_prenom,
            'cli_pseudo'=> $request->cli_pseudo,
            'cli_motpasse' => Hash::make($request->cli_motpasse),
            'cli_telportable' => $request->cli_telportable,
            'cli_telfixe'=>$request->cli_telfixe
        ]);
        return redirect()->route('home');
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
    
    public function authentificate(Request $request) {
        $credentials = $request->validate([
            'cli_mel'=>['required'],
            'cli_motpasse'=>['required']
        ]);
        unset($credentials['cli_motpasse']);
        $credentials['password']=$request->cli_motpasse;
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("home");
        }
        return back()->withErrors([
            'error'=>'Mauvais email ou mot de passe'
        ]);
    }
    
    public function profile() {
        $client = Auth::user();
        if($client)
            return view("profile", ['rayons'=>Rayon::all(),'compte'=>$client]);
        else
            return redirect()->route("login");
    }
}