<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'point', 'special_reward', 'status', 'rank', 'level', 'stt',
    ];

    /**
     * Registering model event to update stt after deleting a row.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($game) {
            $game->decrementStt();
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

    public function enemies()
    {
        return $this->belongsToMany(Enemy::class, 'enemies_in_game', 'game_id', 'enemy_id');
    }

    public function process()
    {
        return $this->hasMany(GameProcess::class);
    }
}
