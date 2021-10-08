<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alerte
 * 
 * @property int $cli_id
 * @property int $jeu_id
 * 
 * @property Client $t_e_client_cli
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */
class Alerte extends Model
{
	protected $table = 't_j_alerte_ale';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'jeu_id' => 'int'
	];

	public function t_e_client_cli()
	{
		return $this->belongsTo(Client::class, 'cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_alerte_ale.cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_alerte_ale.cli_id');
	}

	public function t_e_jeuvideo_jeu()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_j_alerte_ale.jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_j_alerte_ale.jeu_id');
	}
}
