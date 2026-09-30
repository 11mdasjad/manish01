<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_title',
        'company',
        'rating',
        'content',
        'avatar',
        'project_reference',
        'order',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'order' => 'integer',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getAvatarUrlAttribute(): string
    {
        return MediaHelper::resolve($this->avatar, 'https://ui-avatars.com/api/?name='.urlencode($this->client_name).'&background=0f172a&color=fff');
    }
}
