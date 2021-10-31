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
    public function view_login() {
        return view("employe.login");
    }
    
    //Route post for employee to login
    public function login(Request $request) {
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

    public function create(Request $request) {
        $request->validate([
            'add_roles' => ['required'],
            'add_roles.*'=>['exists:t_r_role_rol,rol_id'],
            'add_mail' => ['required','email','max:80','unique:t_e_employe_emp,emp_mel'],
            'add_mdp' => ['required', 'min:8','confirmed'],
        ]);
        $employe = Employe::create([
            'emp_mel'=> $request->add_mail,
            'emp_motpasse' => Hash::make($request->add_mdp),
        ]);
        $employe->update_roles($request->add_roles);
        return back()->withInput(['validation'=>'Le compte "'.$employe->mail().'" à bien été créé.']);
    }

    //Route for admin to add or edit employees
    public function view_manage() {
        $employes = Employe::all()->where('emp_id', '!=', Auth::guard('employe')->id());
        $roles = Role::all();
        return view("employe.administration", ['employes'=>$employes, 'roles'=>$roles]);
    }

    public function view_profile() {
        return view("employe.profile", ['compte'=>Auth::guard('employe')->user()]);
    }

    //Route post for employee to change his email
    public function edit(Request $request) {
        $request->validate([
            'id' => ['required', 'exists:t_e_employe_emp,emp_id'],
            'email' => ['required', 'email','max:80', Rule::unique('t_e_employe_emp','emp_mel')->ignore($request->emp_id,'emp_id')],
        ]);
        $employe = Employe::find($request->id);
        $employe->emp_mel = $request->email;
        $employe->save();
        return back()->withInput(['validation'=>'Votre compte a bien été modifié !']);
    }

    //Route post for admin to add/delete roles and change mail of an employee
    public function edit_admin(Request $request) {
        $request->validate([
            'id' => ['required', 'exists:t_e_employe_emp,emp_id'],
            'mail' => ['required','email','max:80', Rule::unique('t_e_employe_emp','emp_mel')->ignore($request->id,'emp_id')],
            'roles.*' => ['exists:t_r_role_rol,rol_id'],
        ]);

        $emp = Employe::find($request->id);
        $emp->emp_mel = $request->mail;
        $emp->save();

        $new_roles = $request->roles ? $request->roles : [];
        $emp->update_roles($new_roles);
        
        return back()->withInput(['validation'=>'L\'employé "'.$emp->mail().'" a bien été modifié !']);
    }

    public function view_password() {
        return view("employe.password", ['id'=>Auth::guard('employe')->id()]);
    }

    //Route post for employee to change his password
    public function change_password(Request $request) {
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
