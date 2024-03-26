<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_in_event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'event_id',
    ];

    /**
     * Get the item associated with the event.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the event associated with the item.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
