<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $primaryKey = 'listingID';

    protected $fillable = [
        'listingTitle',
        'listingDescription',
        'price',
        'location',
        'contactInfo',
        'roomType',
        'availabilityStatus',
        'user_id',
        'images',
    ];

    protected $casts = [
        'images' => 'array', // Cast images JSON to PHP array on retrieval
        'price' => 'decimal:2',
        'createdDate' => 'datetime',
    ];

    public function user()
    {
        // listings table stores the foreign key as `user_id` that references users.id
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
