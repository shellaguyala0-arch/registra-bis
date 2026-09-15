<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_name',
        'owner_name',
        'address',
        'contact_number',
        'email',
        'valid_id_type',
        'valid_id_number',
        'category',
        'landmark',
        'location_description',
        'latitude',
        'longitude',
        'permit_number',
        'registration_status',
        'payment_status',
        'closure_status',
        'owner_photo',
        'valid_id_file',
        'business_exterior',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function assessments()
    {
        return $this->hasMany(FeeAssessment::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function closures()
    {
        return $this->hasMany(ClosureApplication::class);
    }
}
