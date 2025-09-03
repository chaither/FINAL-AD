<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'name', 'email', 'rating', 'comment', 'is_approved', 'is_featured'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Scope to get featured feedback
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope to get approved feedback
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}


