<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LogKegiatan
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $uraian
 * @property int $peserta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Peserta $peserta
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereJamMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereJamSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LogKegiatan whereUraian($value)
 * @mixin \Eloquent
 */
class LogKegiatan extends Model
{
    protected $table = 'log_kegiatan';

    protected $fillable = ['tanggal', 'jam_mulai', 'jam_selesai', 'uraian', 'peserta_id'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
