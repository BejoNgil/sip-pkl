<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Peserta
 *
 * @property int $id
 * @property string $nama
 * @property int|null $nis
 * @property string $jenis_kelamin
 * @property \Illuminate\Support\Carbon|null $tanggal_lahir
 * @property string|null $alamat
 * @property string|null $telepon
 * @property string|null $foto
 * @property string|null $ayah
 * @property string|null $ibu
 * @property int|null $program_keahlian_id
 * @property int|null $sekolah_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $authenticable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LogKegiatan[] $logKegiatan
 * @property-read int|null $log_kegiatan_count
 * @property-read \App\PKL|null $pkl
 * @property-read \App\ProgramKeahlian|null $programKeahlian
 * @property-read \App\Sekolah|null $sekolah
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereProgramKeahlianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereSekolahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Peserta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Peserta extends Model
{
    protected $table = 'peserta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama','nis','jenis_kelamin','alamat','telepon','foto','ayah','ibu', 'tanggal_lahir','program_keahlian_id','sekolah_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
     ];

    public function authenticable()
    {
        return $this->morphOne(User::class, 'authenticable');
    }

    public function programKeahlian()
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pkl()
    {
        return $this->hasOne(PKL::class);
    }

    public function logKegiatan()
    {
        return $this->hasMany(LogKegiatan::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
