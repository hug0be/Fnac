<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pays
 * 
 * @property int $pay_id
 * @property character varying $pay_nom
 * 
 * @property Collection|Relais[] $t_e_relais_rels
 * @property Collection|Adresse[] $t_e_adresse_adrs
 *
 * @package App\Models
 */
class Pays extends Model
{
	protected $table = 't_r_pays_pay';
	public $timestamps = false;
	protected $primaryKey = 'pay_id';

	protected $casts = [
		'pay_nom' => 'string'
	];

	protected $fillable = [
		'pay_nom'
	];

	public function relais()
	{
		return $this->hasMany(Relais::class, 'pay_id');
	}

	public function adresse()
	{
		return $this->hasMany(Adresse::class, 'pay_id');
	}
	
	public function id()
	{
		return $this->pay_id;
	}
	public function nom()
	{
		return $this->pay_nom;
	}
}
