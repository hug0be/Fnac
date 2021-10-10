<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Console
 * 
 * @property int $con_id
 * @property character varying $con_nom
 * 
 * @property Collection|JeuVideo[] $t_e_jeuvideo_jeus
 *
 * @package App\Models
 */
class Console extends Model
{
	protected $table = 't_r_console_con';
	public $timestamps = false;
	protected $primaryKey = 'con_id';

	// protected $casts = [
	// 	'con_nom' => 'character varying'
	// ];

	protected $fillable = [
		'con_nom'
	];

	public function jeuvideo()
	{
		return $this->hasMany(JeuVideo::class, 'con_id');
	}
}
