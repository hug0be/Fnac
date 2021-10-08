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

	protected $casts = [
		'com_id' => 'int',
		'jeu_id' => 'int',
		'lec_quantite' => 'int'
	];

	protected $fillable = [
		'lec_quantite'
	];

	public function t_e_commande_com()
	{
		return $this->belongsTo(Commande::class, 'com_id')
					->where('t_e_commande_com.com_id', '=', 't_j_lignecommande_lec.com_id')
					->where('t_e_commande_com.com_id', '=', 't_j_lignecommande_lec.com_id');
	}

	public function t_e_jeuvideo_jeu()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_j_lignecommande_lec.jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_j_lignecommande_lec.jeu_id');
	}
}
