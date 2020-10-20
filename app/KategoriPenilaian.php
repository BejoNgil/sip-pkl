<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\KategoriPenilaian
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KategoriPenilaian whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KategoriPenilaian extends Model
{
    protected $table = 'kategori_penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];
}
