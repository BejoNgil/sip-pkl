<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProgramKeahlian
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Peserta[] $peserta
 * @property-read int|null $peserta_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProgramKeahlian whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProgramKeahlian extends Model
{
    protected $table = 'program_keahlian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
