<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $primaryKey = 'bookmarkID';

    protected $fillable = [
        'user_id',
        'listingID',
        'bookmarkedDate',
    ];

    protected $casts = [
        'bookmarkedDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listingID');
    }
}
