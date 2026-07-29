<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'birthdate',
        'gender',
        'emergency_name',
        'emergency_phone',
        'emergency_relationship',
        'id_type',
        'id_number',
        'move_in_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'move_in_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function leaseContracts()
    {
        return $this->hasMany(LeaseContract::class);
    }

    public function activeLease()
    {
        return $this->hasOne(LeaseContract::class)->where('status', 'active');
    } 
}
