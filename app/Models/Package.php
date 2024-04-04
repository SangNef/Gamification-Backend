<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['stt', 'point', 'status', 'price'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($package) {
            $package->decrementStt();
        });
    }

    /**
     * Decrementing stt for rows with stt greater than the deleted row's stt.
     */
    public function decrementStt()
    {
        $stt = $this->stt;
        self::where('stt', '>', $stt)->decrement('stt');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'package_id');
    }
}
