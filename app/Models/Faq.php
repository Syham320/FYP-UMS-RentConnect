<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $primaryKey = 'faqID';

    protected $fillable = [
        'faqQuestion',
        'faqAnswer',
        'user_role',
        'category',
        'is_active',
        'adminID',
        'updatedDate',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'updatedDate' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'adminID', 'id');
    }
}
