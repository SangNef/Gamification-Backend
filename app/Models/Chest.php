<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['stt', 'name', 'image', 'rank', 'type', 'status', 'is_limit', 'can_sell', 'note'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($item) {
            $item->decrementStt();
        });
    }

    /**
     * Decrementing stt for rows with stt greater than the deleted row's stt.
     *
     * @return void
     */
    public function decrementStt()
    {
        $stt = $this->stt;
        self::where('stt', '>', $stt)->decrement('stt');
    }
}
