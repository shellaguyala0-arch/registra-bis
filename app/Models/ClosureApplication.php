<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClosureApplication extends Model { 
    protected $fillable = [
        'business_id',
        'business_name',
        'owner_name',
        'permit_number',
        'reason',
        'status',
        'decision',
        'reviewed_at',

    ];


    protected $casts = [
        'reviewed_at' => 'datetime',

    ];


    public function business()
    {
        return $this->belongsTo(
            Business::class
        );
    }
}