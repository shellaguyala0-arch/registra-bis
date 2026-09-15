<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'assessment_id',
        'reference_no',
        'amount',
        'payment_date',
        'remarks',
        'received_by',


        'complainant_name',
        'complainant_contact',
        'respondent_name',
        'respondent_contact',
        'complaint_type',
        'incident_date',
        'incident_place',
        'complaint_description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'incident_date' => 'date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function assessment()
    {
        return $this->belongsTo(FeeAssessment::class, 'assessment_id');
    }


    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function document()
    {
        return $this->hasOne(Document::class, 'payment_id');
    }
}