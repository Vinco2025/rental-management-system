<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'floor',
        'room_type_id',
        'monthly_rate',
        'status',
        'max_occupants',
        'amenities',
        'notes',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
