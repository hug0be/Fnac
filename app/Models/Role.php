<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Editeur
 * 
 * @property int $rol_id
 * @property string $rol_nom
 * 
 * @property Collection|Client[] $t_e_client_cli
 *
 * @package App\Models
 */
class Role extends Model
{
    protected $table = 't_r_role_rol';
    public $timestamps = false;
    protected $primaryKey = 'rol_id';

    protected $casts = [
        'rol_nom' => 'string'
    ];

    protected $fillable = [
        'rol_nom'
    ];

    public function employeList()
    {
        return $this->belongsToMany(
			Employe::class,
			't_j_employerole_emr',
			'rol_id',
			'emp_id');
    }

    public function id()
    {
        return $this->rol_id;
    }
    public function nom()
    {
        return $this->rol_nom;
    }
}