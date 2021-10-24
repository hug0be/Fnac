<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LigneCommande
 * 
 * @property int $com_id
 * @property int $jeu_id
 * @property int $lec_quantite
 * 
 * @property Commande $t_e_commande_com
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */
class LigneCommande extends Model
{
	protected $table = 't_j_lignecommande_lec';
	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = 'com_id';

	protected $casts = [
		'com_id' => 'int',
		'jeu_id' => 'int',
		'lec_quantite' => 'int'
	];

	protected $fillable = [
		'lec_quantite'
	];

	public function commande()
	{
		return $this->belongsTo(Commande::class, 'com_id');
	}

	public function jeuVideo()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}

	public function id_commande()
	{
		return $this->com_id;
	}
	public function id_jeu()
	{
		return $this->jeu_id;
	}
	public function quantite()
	{
		return $this->lec_quantite;
	}
}
