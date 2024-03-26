<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shop';
    protected $fillable = ['reward_id', 'price', 'status'];
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
