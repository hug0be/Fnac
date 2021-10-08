<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

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

	protected $casts = [
		'jeu_id' => 'int',
		'mot_mot' => 'character varying'
	];

	protected $fillable = [
		'jeu_id',
		'mot_mot'
	];

	public function t_e_jeuvideo_jeu()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_e_motcle_mot.jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_e_motcle_mot.jeu_id');
	}
}
