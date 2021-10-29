<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 't_e_employe_emp';
	public $timestamps = false;
	protected $primaryKey = 'emp_id';

    public function roles()
	{
		return $this->belongsToMany(
			Role::class,
			't_j_employerole_emr',
			'emp_id',
			'rol_id');
	}

    public function id()
	{
		return $this->emp_id;
	}

	public function mail()
	{
		return $this->emp_mel;
	}

	public function motDePasse()
	{
		return $this->emp_motpasse;
	}
}

