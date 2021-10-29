<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeRole
 * 
 * @property int $emp_id
 * @property int $rol_id
 * 
 * @property Employe $t_e_employe_emp
 * @property Role $t_r_role_rol
 *
 * @package App\Models
 */
class EmployeRole extends Model {
	protected $table = 't_j_employerole_emr';
	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = 'emp_id';

	protected $casts = [
		'emp_id' => 'int',
		'rol_id' => 'int',
	];

	protected $fillable = [
		'emp_id',
		'rol_id',
	];

	public function employe() {
		return $this->belongsTo(Employe::class, 'emp_id');
	}

	public function role() {
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function id_employe() {
		return $this->emp_id;
	}
	public function id_role() {
		return $this->rol_id;
	}
}
