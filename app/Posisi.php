<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Posisi
 *
 * @property int $id
 * @property string $nama
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Posisi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Posisi extends Model
{
    protected $table = 'posisi';

    protected $fillable = ['nama'];
}
