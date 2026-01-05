<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $primaryKey = 'complaintID';

    protected $fillable = [
        'complaintCategory',
        'complaintDescription',
        'complaintFile',
        'complaintStatus',
        'userID',
    ];

    protected $casts = [
        'submittedDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
