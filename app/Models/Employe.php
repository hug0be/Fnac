<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 't_e_employe_emp';
	public $timestamps = false;
	protected $primaryKey = 'emp_id';

	protected $hidden = [
        'password',
        'remember_token',
    ];
	
	protected $casts = [
		'emp_mel' => 'string',
		'emp_motpasse' => 'string',
		'email_verified_at',
		'remember_token' => 'string'
	];

	protected $fillable = [
		'emp_mel',
		'emp_motpasse',
	];
	public function getAuthPassword() {
		return $this->emp_motpasse;
	}
    public function roles() {
		return $this->belongsToMany(
			Role::class,
			't_j_employerole_emr',
			'emp_id',
			'rol_id');
	}
	
	public function update_roles($new_roles) {
		foreach(Role::all() as $role) {
            //Deleting roles
            if($this->hasRole($role->nom()) && !in_array($role->id(),$new_roles)) {
                EmployeRole::where('rol_id', $role->id())
                ->where('emp_id',$this->id())
                ->delete();
            }
            //Adding roles
            elseif(!$this->hasRole($role->nom()) && in_array($role->id(),$new_roles)) {
                EmployeRole::create([
                    'emp_id' => $this->id(),
                    'rol_id' => $role->id(),
                ]);
            }
        }
	}
	public function hasRole($role) {
		return $this->roles()->where('rol_nom','=',$role)->count();
	}

    public function id() {
		return $this->emp_id;
	}

	public function mail() {
		return $this->emp_mel;
	}

	public function motDePasse() {
		return $this->emp_motpasse;
	}
}

