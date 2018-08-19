<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['peg_nip','penilaian_id','is_kirim','laporan_kirim','is_persetujuan','laporan_persetujuan'];
}
