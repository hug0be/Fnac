<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Magasin
 * 
 * @property int $mag_id
 * @property character varying $mag_nom
 * @property character varying $mag_ville
 * 
 * @property Collection|Commande[] $t_e_commande_coms
 * @property Collection|Client[] $t_e_client_clis
 *
 * @package App\Models
 */
class Magasin extends Model
{
	protected $table = 't_r_magasin_mag';
	public $timestamps = false;

	protected $casts = [
		'mag_nom' => 'character varying',
		'mag_ville' => 'character varying'
	];

	protected $fillable = [
		'mag_nom',
		'mag_ville'
	];

	public function t_e_commande_coms()
	{
		return $this->hasMany(Commande::class, 'mag_id');
	}

	public function t_e_client_clis()
	{
		return $this->hasMany(Client::class, 'mag_id');
	}
}
