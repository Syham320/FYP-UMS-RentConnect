<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $primaryKey = 'feedbackID';

    protected $fillable = [
        'feedbackType',
        'feedbackText',
        'timeStamp',
        'userID',
        'subject',
        'priority',
        'status'
    ];

    protected $casts = [
        'timeStamp' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
