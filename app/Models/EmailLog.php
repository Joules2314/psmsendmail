<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'email_id',
        'status',
        'log_message',
        'error_details',
    ];

    public function email()
    {
    return $this->belongsTo(Email::class);
    }
}
