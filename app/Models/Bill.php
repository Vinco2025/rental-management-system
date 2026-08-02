<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
        protected $fillable = [
        'lease_contract_id',
        'tenant_id',
        'billing_month',
        'rent_amount',
        'electricity_amount',
        'water_amount',
        'total_amount',
        'amount_paid',
        'balance',
        'status',
        'due_date',
        'notes',
    ];

    protected $casts = [
        'billing_month' => 'date',
        'due_date' => 'date',
        'rent_amount' => 'decimal:2',
        'electricity_amount' => 'decimal:2',
        'water_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    public function leaseContract()
    {
        return $this->belongsTo(LeaseContract::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function recalculate()
    {
        $paid = $this->payments()->sum('amount');
        $this->amount_paid = $paid;
        $this->balance = $this->total_amount - $paid;

        if ($paid <= 0) {
            $this->status = 'unpaid';
        } elseif ($paid >= $this->total_amount) {
            $this->status = 'paid';
        } else {
            $this->status = 'partial';
        }

        $this->save();
    }
}