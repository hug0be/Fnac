<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Editeur
 * 
 * @property int $edi_id
 * @property character varying $edi_nom
 * 
 * @property Collection|JeuVideo[] $t_e_jeuvideo_jeus
 *
 * @package App\Models
 */
class Editeur extends Model
{
	protected $table = 't_r_editeur_edi';
	public $timestamps = false;

	protected $casts = [
		'edi_nom' => 'character varying'
	];

	protected $fillable = [
		'edi_nom'
	];

	public function t_e_jeuvideo_jeus()
	{
		return $this->hasMany(JeuVideo::class, 'edi_id');
	}
}
