<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = ['kegiatan_id','kegiatan_name','kegiatan_desc','kegiatan_loc','kegiatan_start','kegiatan_end'];
}
