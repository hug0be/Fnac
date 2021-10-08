<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Adresse
 * 
 * @property int $adr_id
 * @property int $cli_id
 * @property character varying $adr_nom
 * @property character varying $adr_type
 * @property character varying $adr_rue
 * @property character varying|null $adr_complementrue
 * @property character varying $adr_cp
 * @property character varying $adr_ville
 * @property int $pay_id
 * @property float|null $adr_latitude
 * @property float|null $adr_longitude
 * 
 * @property Client $t_e_client_cli
 * @property Pays $t_r_pays_pay
 * @property Collection|Commande[] $t_e_commande_coms
 *
 * @package App\Models
 */
class Adresse extends Model
{
	protected $table = 't_e_adresse_adr';
	protected $primaryKey = 'adr_id';
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'adr_nom' => 'character varying',
		'adr_type' => 'character varying',
		'adr_rue' => 'character varying',
		'adr_complementrue' => 'character varying',
		'adr_cp' => 'character varying',
		'adr_ville' => 'character varying',
		'pay_id' => 'int',
		'adr_latitude' => 'float',
		'adr_longitude' => 'float'
	];

	protected $fillable = [
		'cli_id',
		'adr_nom',
		'adr_type',
		'adr_rue',
		'adr_complementrue',
		'adr_cp',
		'adr_ville',
		'pay_id',
		'adr_latitude',
		'adr_longitude'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'cli_id');
		
	}

	public function pays()
	{
		return $this->belongsTo(Pays::class, 'pay_id');
	}

	public function commande()
	{
		return $this->hasMany(Commande::class, 'adr_id');
	}
}
