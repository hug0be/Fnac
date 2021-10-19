<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller {
    public function login() {
        return view("client.login");
    }
    public function logout() {
        Auth::logout();
        return redirect()->route("home");
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
            'portable'=>['required_without:fixe'],
            'fixe'=>['required_without:portable'],
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
        return redirect()->route('login');
    }
    
    public function authentificate(Request $request) {
        $credentials = $request->validate([
            'mail'=>['required','email','max:80','exists:t_e_client_cli,cli_mel'],
            'password'=>['required']
        ]);
        unset($credentials['mail']);
        $credentials['cli_mel'] = $request->mail;
        if(Auth::attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            return redirect()->route("home");
        }
        return back()->withErrors([
            'password'=>'Le mot de passe est incorrect.',
        ])->withInput(['mail' => $request->mail]);
    }
}