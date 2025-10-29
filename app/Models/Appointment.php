<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'service_id', 
        'appointment_date',
        'duration',
        'price',
        'status',
        'notes',
        'customer_name',
        'customer_email',  
        'customer_phone'
    ];

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relationship with User (Seller)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}