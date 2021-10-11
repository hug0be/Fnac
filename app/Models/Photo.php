<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * 
 * @property int $pho_id
 * @property int $jeu_id
 * @property character varying $pho_url
 * 
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */
class Photo extends Model
{
	protected $table = 't_e_photo_pho';
	public $timestamps = false;
	protected $primaryKey = 'pho_id';

	//  	

	protected $fillable = [
		'jeu_id',
		'pho_url'
	];

	public function jeuvideo()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}
	
	public function id_photo()
	{
		return $this->pho_id;
	}
	public function id_jeu()
	{
		return $this->jeu_id;
	}
	public function url()
	{
		return $this->pho_url;
	}
}
