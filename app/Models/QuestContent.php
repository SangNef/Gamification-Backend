<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quest_id',
        'content',
    ];

    /**
     * Get the quest that owns the content.
     */
    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }
}
