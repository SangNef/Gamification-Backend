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
        'name', 'point', 'special_reward', 'status', 'rank', 'level',
    ];
    public function enemies()
    {
        return $this->belongsToMany(Enemy::class, 'enemies_in_game', 'game_id', 'enemy_id');
    }
    public function process()
    {
        return $this->hasMany(GameProcess::class);
    }
}
