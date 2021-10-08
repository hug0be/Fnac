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
	protected $primaryKey = 'avi_id';

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

	public function client()
	{
		return $this->belongsTo(Client::class, 'cli_id');
	}

	public function jeuvideo()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}

	public function avisabusif()
	{
		return $this->hasMany(AvisAbusif::class, 'avi_id');
	}

	public function abusifTAB()
	{
		return $this->belongsToMany(
			Genre::class,
			't_j_avisabusif_ava',
			'avi_id',
			'cli_id');
	}
}
