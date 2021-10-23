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
	protected $primaryKey = 'edi_id';

	protected $casts = [
		'edi_nom' => 'string'
	];

	protected $fillable = [
		'edi_nom'
	];

	public function jeuvideo()
	{
		return $this->hasMany(JeuVideo::class, 'edi_id');
	}

	public function id_editeur()
	{
		return $this->edi_id;
	}
	public function nom()
	{
		return $this->edi_nom;
	}
}
