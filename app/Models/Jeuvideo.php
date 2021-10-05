<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeuvideo extends Model
{
    protected $table = "t_e_jeuvideo_jeu";
    protected $primaryKey = "jeu_id";
    public $timestamps = false;
}
