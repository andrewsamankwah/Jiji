<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'photo',
        'contact_number',
        'location',
        'description',
        'status',
    ];

    // Relationship with User (Seller)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Scope for active services only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}