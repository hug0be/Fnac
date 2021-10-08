<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 * 
 * @property int $gen_id
 * @property character varying $gen_libelle
 * 
 * @property Collection|GenreJeu[] $t_j_genrejeu_gejs
 *
 * @package App\Models
 */
class Genre extends Model
{
	protected $table = 't_r_genre_gen';
	public $timestamps = false;


	// public function t_j_genrejeu_gejs()
	// {
	// 	return $this->hasMany(GenreJeu::class, 'gen_id');
	// }

	public function jeuVideos()
	{
		return $this->belongsToMany(
			JeuVideo::class,
			't_j_genrejeu_gej',
			'gen_id',
			'jeu_id',
			'gen_id',
			'jeu_id');
	}

	// protected $casts = [
	// 	'gen_libelle' => 'character varying'
	// ];

	// protected $fillable = [
	// 	'gen_libelle'
	// ];
}
