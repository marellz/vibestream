<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content',
        'user_id',
        'post_id',
        'likes',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
