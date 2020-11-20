<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PKL
 *
 * @property int $id
 * @property int $peserta_id
 * @property int $pembimbing_id
 * @property int $posisi_id
 * @property \Illuminate\Support\Carbon $tanggal_mulai
 * @property \Illuminate\Support\Carbon|null $tanggal_selesai
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Pembimbing $pembimbing
 * @property-read \App\Peserta $peserta
 * @property-read \App\Posisi $posisi
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL wherePembimbingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL wherePosisiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PKL whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PKL extends Model
{
    protected $table = 'pkl';

    protected $fillable = [
        'peserta_id',
        'pembimbing_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'posisi_id',
        'jobdesc'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }

    public function nilai()
    {
        return $this->hasMany(Penilaian::class, 'pkl_id');
    }

    public function getTotalNilaiAttribute()
    {
        $sum = $this->nilai->sum('nilai');
        $count = $this->nilai->count();
        return $count > 0 ? round($sum / $count, 2) : 0;
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'pkl_id');
    }

    public function bimbingan_one()
    {
        return $this->hasOne(Bimbingan::class, 'pkl_id', 'id')->orderBy('id', 'DESC');
    }
}
