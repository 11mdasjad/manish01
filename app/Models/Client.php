<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'website_url',
        'industry',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getLogoUrlAttribute(): string
    {
        return MediaHelper::resolve($this->logo, 'images/placeholder-client.png');
    }
}
