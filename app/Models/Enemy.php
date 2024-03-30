<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    use HasFactory;
    protected $table = 'enemies';
    protected $fillable = ['name', 'hp', 'dame', 'def', 'access', 'type', 'rank'];
    public function games()
    {
        return $this->belongsToMany(Game::class, 'enemies_in_game', 'enemy_id', 'game_id');
    }
}
