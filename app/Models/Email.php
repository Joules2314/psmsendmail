<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
    
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /** @use HasFactory<\Database\Factories\EmailFactory> */
    use HasFactory;

    protected $fillable = [
        'subject',
        'to',
        'cc',
        'bcc',
        'body',
        'attachments',
        'user_id',
        'user_name',
        'system_name',      
    ];

    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'attachments' => 'array',
    ];
}
