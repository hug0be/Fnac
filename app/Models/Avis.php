<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Avis
 * 
 * @property int $avi_id
 * @property int $cli_id
 * @property int $jeu_id
 * @property Carbon $avi_date
 * @property character varying $avi_titre
 * @property character varying $avi_detail
 * @property int $avi_note
 * @property int $avi_nbutileoui
 * @property int $avi_nbutilenon
 * 
 * @property Client $t_e_client_cli
 * @property JeuVideo $t_e_jeuvideo_jeu
 * @property Collection|AvisAbusif[] $t_j_avisabusif_avas
 *
 * @package App\Models
 */
class Avis extends Model
{
	protected $table = 't_e_avis_avi';
	public $timestamps = false;

	protected $casts = [
		'cli_id' => 'int',
		'jeu_id' => 'int',
		'avi_titre' => 'character varying',
		'avi_detail' => 'character varying',
		'avi_note' => 'int',
		'avi_nbutileoui' => 'int',
		'avi_nbutilenon' => 'int'
	];

	protected $dates = [
		'avi_date'
	];

	protected $fillable = [
		'cli_id',
		'jeu_id',
		'avi_date',
		'avi_titre',
		'avi_detail',
		'avi_note',
		'avi_nbutileoui',
		'avi_nbutilenon'
	];

	public function t_e_client_cli()
	{
		return $this->belongsTo(Client::class, 'cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_e_avis_avi.cli_id')
					->where('t_e_client_cli.cli_id', '=', 't_e_avis_avi.cli_id');
	}

	public function t_e_jeuvideo_jeu()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_e_avis_avi.jeu_id')
					->where('t_e_jeuvideo_jeu.jeu_id', '=', 't_e_avis_avi.jeu_id');
	}

	public function t_j_avisabusif_avas()
	{
		return $this->hasMany(AvisAbusif::class, 'avi_id');
	}
}
