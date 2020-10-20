<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bimbingan
 *
 * @property int $id
 * @property int $pkl_id
 * @property string $tanggal
 * @property string $uraian
 *  * @property int $is_approve
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan wherePklId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereUraian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bimbingan whereIsApprove($value)
 * @mixin \Eloquent
 */
class Bimbingan extends Model
{
    protected $table = 'bimbingan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pkl_id', 'tanggal', 'uraian', 'is_approve'];

    protected $casts = [
        'is_approve' => 'boolean',
        'tanggal' => 'date'
    ];

    public function pkl()
    {
        return $this->belongsTo(PKL::class);
    }
}
