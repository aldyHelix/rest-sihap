<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = ['peg_nip','penilai_nip','nilai_pelayanan','nilai_integritas','nilai_komitmen','nilai_disiplin','nilai_kerjasama','nilai_kepemimpinan','is_kirim','date_kirim','is_persetujuan','date_persetujuan','total_penilaian','penilaian_year'];
}
