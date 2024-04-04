<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'access',
        'role',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'role' => 'string',
    ];

    /**
     * Get the role of the NPC.
     *
     * @param  string  $value
     * @return string
     */
    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }
}
