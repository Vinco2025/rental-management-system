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

    protected $casts = [
        'amenities' => 'array',
        'monthly_rate' => 'decimal:2',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
