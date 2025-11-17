<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'requestID';

    protected $fillable = [
        'requestStatus',
        'requestDate',
        'listingID',
        'studentID',
    ];

    protected $casts = [
        'requestDate' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listingID', 'listingID');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'studentID', 'id');
    }
}
