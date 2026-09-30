<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'icon',
        'tagline',
        'short_description',
        'description',
        'features',
        'benefits',
        'process_steps',
        'featured_image',
        'is_featured',
        'status',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'process_steps' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getImageUrlAttribute(): string
    {
        return MediaHelper::resolve($this->featured_image, 'images/properties/luxury-villa.jpg');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->image_url;
    }

    public static function generateSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', "{$slug}%")->count();

        return $count ? "{$slug}-".($count + 1) : $slug;
    }
}
