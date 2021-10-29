<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Collection;
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
class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 't_e_client_cli';
	public $timestamps = false;
	protected $primaryKey = 'cli_id';

	protected $hidden = [
        'password',
        'remember_token',
    ];
	
	protected $casts = [
		'cli_mel' => 'string',
		'cli_motpasse' => 'string',
		'cli_pseudo' => 'string',
		'cli_civilite' => 'string',
		'cli_nom' => 'string',
		'cli_prenom' => 'string',
		'cli_telfixe' => 'string',
		'cli_telportable' => 'string',
		'mag_id' => 'int',
		'email_verified_at',
		'remember_token'
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
	public function getAuthPassword() {
		return $this->cli_motpasse;
	}
	public function magasin()
	{
		return $this->belongsTo(Magasin::class, 'mag_id');
	}

	public function avisList()
	{
		return $this->hasMany(Avis::class, 'cli_id');
	}

	public function commandeList()
	{
		return $this->hasMany(Commande::class, 'cli_id');
	}

	public function alerteList()
	{
		return $this->hasMany(Alerte::class, 'cli_id');
	}

	public function avisAbusifList()
	{
		return $this->hasMany(AvisAbusif::class, 'cli_id');
	}

	public function relaisList()
	{
		return $this->belongsToMany(
			Relais::class,
			't_j_relaisclient_rec',
			'cli_id',
			'rel_id');
	}

	public function adresseList()
	{
		return $this->hasMany(Adresse::class, 'cli_id');
	}

	public function jeuFavoris()
	{
		return $this->belongsToMany(
			JeuVideo::class,
			't_j_favori_fav',
			'cli_id',
			'jeu_id');
	}

	public function jeuAlertes()
	{
		return $this->belongsToMany(
			JeuVideo::class,
			't_j_alerte_ale',
			'cli_id',
			'jeu_id');
	}


	public function id()
	{
		return $this->cli_id;
	}
	public function mail()
	{
		return $this->cli_mel;
	}
	public function motDePasse()
	{
		return $this->cli_motpasse;
	}
	public function pseudo()
	{
		return $this->cli_pseudo;
	}
	public function civilite()
	{
		return $this->cli_civilite;
	}
	public function nom()
	{
		return $this->cli_nom;
	}
	public function prenom()
	{
		return $this->cli_prenom;
	}
	public function telFixe()
	{
		return $this->cli_telfixe;
	}
	public function telPortable()
	{
		return $this->cli_telportable;
	}


	public function surnameFirstLetter()
	{
		return strtoupper( substr( $this->nom(), 0, 1) );
	}

	public function firstnameUcFirst()
	{
		return ucfirst( $this->prenom() ) ;
	}

	public function boughtThisGame(int $idGame): bool
	{
		foreach($this->commandeList as $commande)
		{
			foreach($commande->ligneCommandeList as $ligneCommande)
			{
				if($ligneCommande->id_jeu() == $idGame)
				{
					return true;
				}
			}
		}
		return false;
	}

	public function haveThisGameInfavorite(int $idGame): bool
	{
		foreach($this->jeuFavoris as $favori)
			if($favori->id() == $idGame) return true;
			
		return false;
	}
}
