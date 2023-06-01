<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'surname',
        'nick',
        'email',
        'image',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function senders()
    {
        return $this->hasMany(Message::class, 'sender');
    }

    public function receivers()
    {
        return $this->hasMany(Message::class, 'receiver');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'follower');
    }

    public function followings()
    {
        return $this->hasMany(Follower::class, 'following');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'commentator');
    }

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
