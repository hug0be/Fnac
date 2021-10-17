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
	public $timestamps = false;
	protected $primaryKey = 'avi_id';

	protected $casts = [
		'cli_id' => 'int',
		'avi_id' => 'int'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'cli_id');
	}

	public function avis()
	{
		return $this->belongsTo(Avis::class, 'avi_id');
	}
}
