<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    protected $fillable = ['rapat_id','rapat_name','rapat_desc','rapat_loc','rapat_time'];
}
