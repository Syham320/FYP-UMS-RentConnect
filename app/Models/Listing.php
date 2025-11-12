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
        'userID',
        'images',
    ];

    protected $casts = [
        'images' => 'array', // Cast images to array
        'price' => 'decimal:2',
        'createdDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
