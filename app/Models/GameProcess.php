<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProcess extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_processes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'user_id', 'status', 'completed_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'completed_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the game associated with the game process.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the user associated with the game process.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
