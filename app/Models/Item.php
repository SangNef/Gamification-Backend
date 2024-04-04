<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['stt', 'name', 'image', 'rank', 'type', 'status', 'is_limit', 'can_sell', 'note'];
}
