<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaseContract extends Model
{
    protected $fillable = [
        'tenant_id',
        'room_id',
        'start_date',
        'end_date',
        'monthly_rate',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rate' => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
