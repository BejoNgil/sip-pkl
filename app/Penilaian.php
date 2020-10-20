<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Penilaian
 *
 * @property int $id
 * @property int $kategori_penilaian_id
 * @property int $pkl_id
 * @property int $nilai
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\KategoriPenilaian $kategori
 * @property-read \App\PKL $pkl
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereKategoriPenilaianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian wherePklId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penilaian whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Penilaian extends Model
{
    protected $table = 'penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kategori_penilaian_id','pkl_id','nilai','keterangan'];

    public function kategori()
    {
        return $this->belongsTo(KategoriPenilaian::class, 'kategori_penilaian_id');
    }

    public function pkl()
    {
        return $this->belongsTo(PKL::class);
    }
}
