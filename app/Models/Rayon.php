<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rayon
 * 
 * @property int $ray_id
 * @property character varying $ray_nom
 * 
 * @property Collection|JeuRayon[] $t_j_jeurayon_jers
 *
 * @package App\Models
 */
class Rayon extends Model
{
	protected $table = 't_r_rayon_ray';
	protected $primaryKey = 'ray_id';
	public $timestamps = false;

	public function jeuVideoList()
	{
		return $this->belongsToMany(
			JeuVideo::class,
			't_j_jeurayon_jer',
			'ray_id',
			'jeu_id');
	}

	// public function __get($key)
	// {
		
	// 	if(property_exists(get_class($this), $key))
	// 	{
	// 		return $this->$key;
			
	// 	}
	// 	else {
	// 		$key = "ray_".$key;
	// 		return $this->$key;
	// 	}
	// }

	// protected $casts = [
	// 	'ray_nom' => 'character varying'
	// ];

	// protected $fillable = [
	// 	'ray_nom'
	// ];
	
	public function id_rayon()
	{
		return $this->ray_id;
	}
	public function nom()
	{
		return $this->ray_nom;
	}
}
