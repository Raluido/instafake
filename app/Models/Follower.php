<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following');
    }
}
