<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\EmployeRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeController extends Controller {
    public function login() {
        return view("employe.login");
    }
    
    public function authentificate(Request $request) {
        $credentials = $request->validate([
            'mail'=>['required','email','max:80','exists:t_e_employe_emp,emp_mel'],
            'password'=>['required']
        ]);
        unset($credentials['mail']);
        $credentials['emp_mel'] = $request->mail;
        if(Auth::guard('employe')->attempt($credentials, $request->remember_me)) {   
            Auth::logout();
            $request->session()->regenerate();
            return redirect()->route("home")->withInput(["validation"=>"Vous êtes authentifié !"]);
        }
        return back()->withErrors([
            'password'=>'Le mot de passe est incorrect.',
        ])->withInput(['mail' => $request->mail]);
    }
    
    public function register() {
        $roles = Role::all();
        return view("employe.register", ['roles' => $roles]);
    }

    public function create(Request $request) {
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

    public function profile() {
        return view("employe.profile", ['compte'=>Auth::guard('employe')->user()]);
    }

    public function edit(Request $request) {
        $validated = $request->validate([
            'emp_id' => ['required', 'exists:t_e_employe_emp,emp_id'],
            'email' => ['required','email','max:80', Rule::unique('t_e_employe_emp','emp_mel')->ignore($request->emp_id,'emp_id')],
        ]);
        $employe = Employe::find($request->emp_id);
        $employe->emp_mel = $request->email;
        $employe->save();
        return back()->withInput(['validation'=>'Votre compte a bien été modifié !']);
    }

    public function password() {
        return view("employe.password", ['id'=>Auth::guard('employe')->id()]);
    }
    public function changePassword(Request $request) {
        $request->validate([
            'emp_id' => ['required', 'exists:t_e_employe_emp,emp_id'],
            'current_password' => ['required', 
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::guard('employe')->user()->getAuthPassword())) {
                        return $fail(__('Le mot de passe courant est incorrect.'));
                    }
                }
            ],
            'new_password' => ['required', 'min:8','confirmed'],
        ]);
        $employe = Employe::find($request->emp_id);
        $employe->emp_motpasse = Hash::make($request->new_password);
        $employe->save();
        return back()->withInput(['validation'=>'Votre mot de passe à bien été modifié.']);
    }
}
