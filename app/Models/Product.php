<?php

namespace App\Models;

use App\Support\MediaHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'tagline',
        'short_description',
        'description',
        'features',
        'specifications',
        'applications',
        'price_range',
        'featured_image',
        'gallery',
        'brochure_file',
        'is_featured',
        'status',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'applications' => 'array',
        'gallery' => 'array',
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
        return MediaHelper::resolve($this->featured_image, 'images/properties/residential-plots.jpg');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->image_url;
    }

    public static function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'like', "{$slug}%")->count();

        return $count ? "{$slug}-".($count + 1) : $slug;
    }
}
