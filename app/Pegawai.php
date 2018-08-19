<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nip','nama','gelar_depan','gelar_belakang','jabatan_id','golongan_id','atasan_nip'];
}
