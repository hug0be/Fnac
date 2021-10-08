<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Relais
 * 
 * @property int $rel_id
 * @property character varying $rel_nom
 * @property character varying $rel_rue
 * @property character varying $rel_cp
 * @property character varying $rel_ville
 * @property int $pay_id
 * @property float|null $rel_latitude
 * @property float|null $rel_longitude
 * 
 * @property Pays $t_r_pays_pay
 * @property Collection|Commande[] $t_e_commande_coms
 * @property Collection|RelaisClient[] $t_j_relaisclient_recs
 *
 * @package App\Models
 */
class Relais extends Model
{
	protected $table = 't_e_relais_rel';
	public $timestamps = false;
	protected $primaryKey = 'rel_id';

	protected $casts = [
		'rel_nom' => 'character varying',
		'rel_rue' => 'character varying',
		'rel_cp' => 'character varying',
		'rel_ville' => 'character varying',
		'pay_id' => 'int',
		'rel_latitude' => 'float',
		'rel_longitude' => 'float'
	];

	protected $fillable = [
		'rel_nom',
		'rel_rue',
		'rel_cp',
		'rel_ville',
		'pay_id',
		'rel_latitude',
		'rel_longitude'
	];

	public function pays()
	{
		return $this->belongsTo(Pays::class, 'pay_id');
	}

	public function commande()
	{
		return $this->hasMany(Commande::class, 'rel_id');
	}

	public function relaisclient()
	{
		return $this->hasMany(RelaisClient::class, 'rel_id');
	}

	public function relaisClientTAB()
	{
		return $this->belongsToMany(
			Genre::class,
			't_j_relaisclient_rec',
			'rel_id',
			'cli_id');
	}
}
