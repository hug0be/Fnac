<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favori
 * 
 * @property int $cli_id
 * @property int $jeu_id
 * 
 * @property Client $t_e_client_cli
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */

class Favori extends Model {
    protected $table = 't_j_favori_fav';
	public $timestamps = false;
	protected $primaryKey = 'jeu_id';

	protected $casts = [
		'cli_id' => 'int',
		'jeu_id' => 'int'
	];

	public function client() {
		return $this->belongsTo(Client::class, 'cli_id');
	}

	public function jeu()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}
}
