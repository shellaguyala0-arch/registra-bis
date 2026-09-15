<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'transaction_type',
        'assessed_amount',
        'assessment_date',
        'status',
        'assessed_by',
        'remarks',
    ];

    protected $casts = [
        'assessed_amount' => 'decimal:2',
        'assessment_date' => 'date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class, 'assessment_id');
    }

    public function getPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return max(
            0,
            (float) $this->assessed_amount - (float) $this->paid
        );
    }
}