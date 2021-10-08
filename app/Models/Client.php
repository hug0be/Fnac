<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * 
 * @property int $cli_id
 * @property character varying $cli_mel
 * @property character varying $cli_motpasse
 * @property character varying $cli_pseudo
 * @property character varying $cli_civilite
 * @property character varying $cli_nom
 * @property character varying $cli_prenom
 * @property character varying|null $cli_telfixe
 * @property character varying|null $cli_telportable
 * @property int|null $mag_id
 * 
 * @property Magasin|null $t_r_magasin_mag
 * @property Collection|Avis[] $t_e_avis_avis
 * @property Collection|Commande[] $t_e_commande_coms
 * @property Collection|Alerte[] $t_j_alerte_ales
 * @property Collection|AvisAbusif[] $t_j_avisabusif_avas
 * @property Collection|Favori[] $t_j_favori_favs
 * @property Collection|RelaisClient[] $t_j_relaisclient_recs
 * @property Collection|Adresse[] $t_e_adresse_adrs
 *
 * @package App\Models
 */
class Client extends Model
{
	protected $table = 't_e_client_cli';
	public $timestamps = false;

	protected $casts = [
		'cli_mel' => 'character varying',
		'cli_motpasse' => 'character varying',
		'cli_pseudo' => 'character varying',
		'cli_civilite' => 'character varying',
		'cli_nom' => 'character varying',
		'cli_prenom' => 'character varying',
		'cli_telfixe' => 'character varying',
		'cli_telportable' => 'character varying',
		'mag_id' => 'int'
	];

	protected $fillable = [
		'cli_mel',
		'cli_motpasse',
		'cli_pseudo',
		'cli_civilite',
		'cli_nom',
		'cli_prenom',
		'cli_telfixe',
		'cli_telportable',
		'mag_id'
	];

	public function t_r_magasin_mag()
	{
		return $this->belongsTo(Magasin::class, 'mag_id')
					->where('t_r_magasin_mag.mag_id', '=', 't_e_client_cli.mag_id')
					->where('t_r_magasin_mag.mag_id', '=', 't_e_client_cli.mag_id');
	}

	public function t_e_avis_avis()
	{
		return $this->hasMany(Avis::class, 'cli_id');
	}

	public function t_e_commande_coms()
	{
		return $this->hasMany(Commande::class, 'cli_id');
	}

	public function t_j_alerte_ales()
	{
		return $this->hasMany(Alerte::class, 'cli_id');
	}

	public function t_j_avisabusif_avas()
	{
		return $this->hasMany(AvisAbusif::class, 'cli_id');
	}

	public function t_j_favori_favs()
	{
		return $this->hasMany(Favori::class, 'cli_id');
	}

	public function t_j_relaisclient_recs()
	{
		return $this->hasMany(RelaisClient::class, 'cli_id');
	}

	public function t_e_adresse_adrs()
	{
		return $this->hasMany(Adresse::class, 'cli_id');
	}
}
