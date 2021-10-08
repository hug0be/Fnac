<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AvisAbusif
 * 
 * @property int $cli_id
 * @property int $avi_id
 * 
 * @property Client $t_e_client_cli
 * @property Avis $t_e_avis_avi
 *
 * @package App\Models
 */
class AvisAbusif extends Model
{
	protected $table = 't_j_avisabusif_ava';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'avi_id' => 'int'
	];

	public function t_e_client_cli()
	{
		return $this->belongsTo(Client::class, 'cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_avisabusif_ava.cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_j_avisabusif_ava.cli_id');
	}

	public function t_e_avis_avi()
	{
		return $this->belongsTo(Avis::class, 'avi_id')
					->where('t_e_avis_avi.avi_id', '=', 't_j_avisabusif_ava.avi_id')
					->where('t_e_avis_avi.avi_id', '=', 't_j_avisabusif_ava.avi_id');
	}
}
