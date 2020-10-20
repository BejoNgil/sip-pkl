<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Absensi
 *
 * @property int $id
 * @property int $peserta_id
 * @property string $tanggal
 * @property string|null $jam_masuk
 * @property string|null $jam_pulang
 * @property string $status_kehadiran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereJamMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereJamPulang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereStatusKehadiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Absensi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = ['tanggal', 'jam_masuk', 'jam_pulang','peserta_id'];

    public function getStatusAttribute()
    {

    }
}
