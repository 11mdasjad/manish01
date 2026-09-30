<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'category',
        'image',
        'description',
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

    public function getImageUrlAttribute(): string
    {
        return MediaHelper::resolve($this->image, 'images/placeholder-gallery.jpg');
    }
}
