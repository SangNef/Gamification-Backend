<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'max_completion', 'point', 'exp', 'gold', 'level_requirement', 'status',
];
 public function content()
    {
        return $this->hasOne(QuestContent::class);
    }
    // Quest.php
 public function questContent()
    {
        return $this->hasOne(QuestContent::class);
    }

}
