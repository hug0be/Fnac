<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\MotCle as ModelsMotCle;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MotCle
 * 
 * @property int $mot_id
 * @property int $jeu_id
 * @property character varying $mot_mot
 * 
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */
class MotCle extends Model
{
	protected $table = 't_e_motcle_mot';
	public $timestamps = false;
	protected $primaryKey = 'mot_id';
/*
	protected $casts = [
		'jeu_id' => 'int',
		'mot_mot' => 'character varying'
	];
*/
	protected $fillable = [
		'jeu_id',
		'mot_mot'
	];

	public function jeuvideo()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}
	
	public function id_motcle()
	{
		return $this->mot_id;
	}
	public function id_jeu()
	{
		return $this->jeu_id;
	}
	public function mot()
	{
		return $this->mot_mot;
	}

	public static function listMotsUpper()
	{
		$listMots = [];
		$mots = MotCle::all();
		foreach($mots as $mot){
			$listMots[] = strtoupper($mot->mot());
		}
		return $listMots;
	}

	public static function findMot($mot){
		if(in_array(strtoupper($mot), MotCle::listMotsUpper())){
			return true;
			}
		return false;
	}
}
