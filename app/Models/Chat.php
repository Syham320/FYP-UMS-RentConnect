<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $primaryKey = 'chatID';

    protected $fillable = [
        'requestStatus',
        'landlordID',
        'studentID',
        'createdDate',
        'listing_id'
    ];

    protected $casts = [
        'createdDate' => 'datetime',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlordID');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'studentID');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chatID')->orderBy('timeStamp');
    }

    public function listing()
    {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'listingID');
    }

    public function getUnreadCountForUser($userId)
    {
        $lastMessageFromUser = $this->messages()->where('senderID', $userId)->latest('timeStamp')->first();

        if ($lastMessageFromUser) {
            return $this->messages()->where('senderID', '!=', $userId)
                ->where('timeStamp', '>', $lastMessageFromUser->timeStamp)
                ->count();
        } else {
            return $this->messages()->where('senderID', '!=', $userId)->count();
        }
    }
}
