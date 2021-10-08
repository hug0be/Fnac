<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commande
 * 
 * @property int $com_id
 * @property int $cli_id
 * @property int|null $rel_id
 * @property int|null $adr_id
 * @property int|null $mag_id
 * @property Carbon $com_date
 * 
 * @property Client $t_e_client_cli
 * @property Relais|null $t_e_relais_rel
 * @property Adresse|null $t_e_adresse_adr
 * @property Magasin|null $t_r_magasin_mag
 * @property Collection|LigneCommande[] $t_j_lignecommande_lecs
 *
 * @package App\Models
 */
class Commande extends Model
{
	protected $table = 't_e_commande_com';
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'rel_id' => 'int',
		'adr_id' => 'int',
		'mag_id' => 'int'
	];

	protected $dates = [
		'com_date'
	];

	protected $fillable = [
		'cli_id',
		'rel_id',
		'adr_id',
		'mag_id',
		'com_date'
	];

	public function t_e_client_cli()
	{
		return $this->belongsTo(Client::class, 'cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_e_commande_com.cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_e_commande_com.cli_id');
	}

	public function t_e_relais_rel()
	{
		return $this->belongsTo(Relais::class, 'rel_id')
					->where('t_e_relais_rel.rel_id', '=', 't_e_commande_com.rel_id')
					->where('t_e_relais_rel.rel_id', '=', 't_e_commande_com.rel_id');
	}

	public function t_e_adresse_adr()
	{
		return $this->belongsTo(Adresse::class, 'adr_id')
					->where('t_e_adresse_adr.adr_id', '=', 't_e_commande_com.adr_id')
					->where('t_e_adresse_adr.adr_id', '=', 't_e_commande_com.adr_id');
	}

	public function t_r_magasin_mag()
	{
		return $this->belongsTo(Magasin::class, 'mag_id')
					->where('t_r_magasin_mag.mag_id', '=', 't_e_commande_com.mag_id')
					->where('t_r_magasin_mag.mag_id', '=', 't_e_commande_com.mag_id');
	}

	public function t_j_lignecommande_lecs()
	{
		return $this->hasMany(LigneCommande::class, 'com_id');
	}
}
