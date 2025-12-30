<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationForm extends Model
{
    use HasFactory;

    protected $table = 'accommodation_forms';

    protected $primaryKey = 'registrationID';

    protected $fillable = [
        'fullName',
        'matricNumber',
        'address',
        'landlordName',
        'rentalType',
        'rentalAgreement',
        'paymentProof',
        'status',
        'submittedDate',
        'studentID',
        'rentalRequestID',
    ];

    protected $casts = [
        'submittedDate' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'studentID', 'id');
    }
}
