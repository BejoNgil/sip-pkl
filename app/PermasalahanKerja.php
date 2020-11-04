<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermasalahanKerja extends Model
{
    protected $table = 'permasalahan_kerja';

    protected $fillable = [
        'tanggal', 'masalah', 'solusi', 'pkl_id'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function pkl()
    {
        return $this->belongsTo(PKL::class);
    }

    public function detail_masalah()
    {
        return $this->hasMany('App\DetailPermasalahan', 'permasalahan_kerja_id');
    }

    public function respon_pembimbing()
    {
        return $this->hasMany('App\DetailPermasalahan', 'permasalahan_kerja_id');
    }
}
