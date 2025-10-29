<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'price',
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

    // Scope for active products only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}