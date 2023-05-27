<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower',
        'following'
    ];

    public function userFollower()
    {
        return $this->belongsTo(User::class, 'follower');
    }

    public function userFollowing()
    {
        return $this->belongsTo(User::class, 'following');
    }
}
