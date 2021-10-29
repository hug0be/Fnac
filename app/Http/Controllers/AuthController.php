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
    public function loginEmp() {
        return view("employe.login");
    }
    public function logout() {
        Auth::logout();
        return redirect()->back();
    }
    public function register() {
        return view("client.register");
    }
    public function registerEmp() {
        $roles = Role::all();
        return view("employe.register", ['roles' => $roles]);
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
    public function createAccountEmp(Request $request) {
        //dd($request->request);
        $request->validate([
            'role'=>['required'],
            'mail' => ['required','email','max:80','unique:t_e_employe_emp,emp_mel'],
            'mdp' => ['required', 'min:8','confirmed'],
        ]);
        $employe = Employe::create([
            'emp_mel'=> $request->mail,
            'emp_motpasse' => Hash::make($request->mdp),
        ]);
        EmployeRole::create([
            'emp_id' => $employe->id(),
            'rol_id' => $request->role
        ]);
        return redirect()->route('emp.login')->withInput(['validation'=>'Votre compte à été créé. Veuillez vous identifier']);
    }
    public function authentificate(Request $request) {
        $credentials = $request->validate([
            'mail'=>['required','email','max:80','exists:t_e_client_cli,cli_mel'],
            'password'=>['required']
        ]);
        unset($credentials['mail']);
        $credentials['cli_mel'] = $request->mail;
        if(Auth::guard('client')->attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            return back()->withInput(["validation"=>"Vous êtes authentifié !"]);
        }
        return back()->withErrors([
            'password'=>'Le mot de passe est incorrect.',
        ])->withInput(['mail' => $request->mail]);
    }
    public function authentificateEmp(Request $request) {
        $credentials = $request->validate([
            'mail'=>['required','email','max:80','exists:t_e_employe_emp,emp_mel'],
            'password'=>['required']
        ]);
        unset($credentials['mail']);
        $credentials['emp_mel'] = $request->mail;
        //dd(Auth::guard('employee'));
        if(Auth::guard('employee')->attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            return redirect()->route("home")->withInput(["validation"=>"Vous êtes authentifié !"]);
        }
        return back()->withErrors([
            'password'=>'Le mot de passe est incorrect.',
        ])->withInput(['mail' => $request->mail]);
    }

}