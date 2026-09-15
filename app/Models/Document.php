<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Business;
use App\Models\Payment;
use App\Models\User;

class Document extends Model
{
    protected $fillable = [
        'business_id',
        'payment_id',
        'document_type',
        'document_no',
        'purpose',
        'requester_last_name',
        'requester_first_name',
        'requester_middle_name',
        'requester_birthdate',
        'requester_age',
        'requester_sex',
        'requester_birthplace',
        'requester_marital_status',
        'requester_blood_type',
        'requester_citizenship',
        'requester_contact',
        'requester_address',
        'issued_date',
        'status',
        'issued_by',
        'remarks',
    ];


    protected $casts = [
        'issued_date' => 'date',
        'requester_birthdate' => 'date',
    ];

    public function business()
    {
        return $this->belongsTo(
            Business::class
        );
    }


    public function payment()
    {
        return $this->belongsTo(
            Payment::class
        );
    }

    public function issuer()
    {
        return $this->belongsTo(
            User::class,
            'issued_by'
        );
    }
}
