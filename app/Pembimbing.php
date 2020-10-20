<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pembimbing
 *
 * @property int $id
 * @property string $nama
 * @property string|null $jenis_kelamin
 * @property string|null $alamat
 * @property string|null $telepon
 * @property string|null $divisi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $authenticable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereDivisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pembimbing whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pembimbing extends Model
{
    protected $table = 'pembimbing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama','jenis_kelamin','alamat','telepon','divisi'];

    public function authenticable()
    {
        return $this->morphOne(User::class, 'authenticable');
    }
}
