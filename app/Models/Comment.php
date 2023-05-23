<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'content'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function likesComments()
    {
        return $this->hasMany(LikeComment::class);
    }
}
