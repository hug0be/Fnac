<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 * 
 * @property int $vid_id
 * @property int $jeu_id
 * @property character varying $vid_url
 * 
 * @property JeuVideo $t_e_jeuvideo_jeu
 *
 * @package App\Models
 */
class Video extends Model
{
	protected $table = 't_e_video_vid';
	public $timestamps = false;
	protected $primaryKey = 'vid_id';

	protected $casts = [
		'jeu_id' => 'int',
		'vid_url' => 'character varying'
	];

	protected $fillable = [
		'jeu_id',
		'vid_url'
	];

	public function jeuvideo()
	{
		return $this->belongsTo(JeuVideo::class, 'jeu_id');
	}
}
