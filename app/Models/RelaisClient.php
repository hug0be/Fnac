<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RelaisClient
 * 
 * @property int $cli_id
 * @property int $rel_id
 * 
 * @property Client $t_e_client_cli
 * @property Relais $t_e_relais_rel
 *
 * @package App\Models
 */
class RelaisClient extends Model
{
	protected $table = 't_j_relaisclient_rec';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'rel_id' => 'int'
	];

	public function t_e_client_cli()
	{
		return $this->belongsTo(Client::class, 'cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_relaisclient_rec.cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_relaisclient_rec.cli_id');
	}

	public function t_e_relais_rel()
	{
		return $this->belongsTo(Relais::class, 'rel_id')
					->where('t_e_relais_rel.rel_id', '=', 't_j_relaisclient_rec.rel_id')
					->where('t_e_relais_rel.rel_id', '=', 't_j_relaisclient_rec.rel_id');
	}
}
