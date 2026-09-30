<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'department',
        'bio',
        'image',
        'linkedin_url',
        'twitter_url',
        'email',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getImageUrlAttribute(): string
    {
        return MediaHelper::resolve($this->image, 'images/placeholder-team.jpg');
    }
}
