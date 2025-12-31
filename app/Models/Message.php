<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'messageContent',
        'senderID',
        'chatID'
    ];

    protected $casts = [
        'timeStamp' => 'datetime',
        'messageContent' => 'encrypted',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderID');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chatID');
    }
}
