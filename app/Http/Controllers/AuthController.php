<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employe;
use App\Models\EmployeRole;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller {
    public function login() {
        return view("client.login");
    }
    public function logout(Request $request) {
        Auth::logout();
        Auth::guard('employe')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }
    public function register() {
        return view("client.register");
    }
    public function createAccount(Request $request) {
        $validated = $request->validate([
            'civilite' =>  ['required', Rule::in(['M','Mme','Mlle'])],
            'mail' => ['required','email','max:80','unique:t_e_client_cli,cli_mel'],
            'mdp' => ['required', 'min:8','confirmed'],
            'nom' =>['required','alpha','max:50'],
            'prenom'=>['required','alpha','max:50'],
            'pseudo'=>['required','max:20'],
            'portable'=>['nullable', 'required_without:fixe','regex:/^[0-9]{10}$/'],
            'fixe'=>['nullable', 'required_without:portable','regex:/^[0-9]{10}$/'],
        ]);
        $client = Client::create([
            'cli_civilite' => $request->civilite,
            'cli_mel'=> $request->mail,
            'cli_nom' => $request->nom,
            'cli_prenom' => $request->prenom,
            'cli_pseudo'=> $request->pseudo,
            'cli_motpasse' => Hash::make($request->mdp),
            'cli_telportable' => $request->portable,
            'cli_telfixe'=>$request->fixe
        ]);
        return redirect()->route('login')->withInput(['validation'=>'Votre compte à été créé. Veuillez vous identifier']);
    }
    public function authentificate(Request $request) {
        $credentials = $request->validate([
            'mail'=>['required','email','max:80','exists:t_e_client_cli,cli_mel'],
            'password'=>['required']
        ]);
        unset($credentials['mail']);
        $credentials['cli_mel'] = $request->mail;
        if(Auth::guard('client')->attempt($credentials, $request->remember_me)) {
            Auth::guard('employe')->logout();
            $request->session()->regenerate();
            return back()->withInput(["validation"=>"Vous êtes authentifié !"]);
        }
        return back()->withErrors([
            'password'=>'Le mot de passe est incorrect.',
        ])->withInput(['mail' => $request->mail]);
    }
}