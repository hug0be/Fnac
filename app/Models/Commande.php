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
	protected $primaryKey = 'com_id';

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

	public function client()
	{
		return $this->belongsTo(Client::class, 'cli_id');
	}

	public function relais()
	{
		return $this->belongsTo(Relais::class, 'rel_id');
	}

	public function adresse()
	{
		return $this->belongsTo(Adresse::class, 'adr_id');
	}

	public function magasin()
	{
		return $this->belongsTo(Magasin::class, 'mag_id');
	}

	public function ligneCommandeList()
	{
		return $this->hasMany(LigneCommande::class, 'com_id');
	}

	
	public function id_commentaire()
	{
		return $this->com_id;
	}
	public function id_client()
	{
		return $this->cli_id;
	}
	public function id_relais()
	{
		return $this->rel_id;
	}
	public function id_adresse()
	{
		return $this->adr_id;
	}
	public function id_magasin()
	{
		return $this->mag_id;
	}
	public function date()
	{
		return $this->com_date;
	}


	public function typeDelivery() {
		
		if ( $this->isDeliveryRelay()) {
			$typeDelivery = "Relais" ;
		}
		elseif ($this->isDeliveryHouse()) {
			$typeDelivery = "Domicile" ;
		}
		elseif ($this->isDeliveryStore()) {
			$typeDelivery = "Magasin" ;
		}

		return $typeDelivery;
	}


	public function isDeliveryRelay() {
		if ( $this->rel_id != null ) {
			return true ;
		}
	}

	public function isDeliveryHouse() {
		if ($this->adr_id != null ) {
			return true ;
		}
	}

	public function isDeliveryStore() {
		if ($this->mag_id != null ) {
			return true ;
		}
	}

	public function getTotalPrice()
	{
		$priceTotal = 0.00;

		foreach( $this->ligneCommandeList as $aLigneCommande ) {
			$priceTotal += $aLigneCommande->jeuvideo->jeu_prixttc ;
		}

		return $priceTotal;
	}

	public function totalOrderEuro() 
	{
		return floatval((explode(".",strval($this->getTotalPrice()))[0]));

	}

	public function totalOrderCentime() {

		$priceTotal = $this->getTotalPrice();

		// foreach( $this->ligneCommandeList as $aLigneCommande ) {
		// 	$priceTotal += $aLigneCommande->jeuvideo->jeu_prixttc ;
		// }
		$cents = (explode(".",strval($priceTotal))[1]);

		return floatval( strlen($cents)==1 ? $cents . "0" : $cents);

	}

}
