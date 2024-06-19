<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cover_photo',
        'date_of_birth',
        'location',
        'website',
        'social_urls',
        'phone_number_alt',
        'occupation',
        'education',
        'status',
    ];
    
    protected $cast = [
        'date_of_birth' => 'datetime',
        'social_urls' => 'json',
        'location' => 'json'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
