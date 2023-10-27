<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver'
    ];

    public function userSender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function userReceiver()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}
