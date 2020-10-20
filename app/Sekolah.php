<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Sekolah
 *
 * @property int $id
 * @property string $nama
 * @property string|null $telepon
 * @property string|null $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Peserta[] $peserta
 * @property-read int|null $peserta_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sekolah whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sekolah extends Model
{
    protected $table = 'sekolah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama','telepon','alamat'];

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
