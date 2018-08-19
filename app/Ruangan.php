<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable = ['ruangan_id','ruangan_name','lantai_ruangan'];
}
