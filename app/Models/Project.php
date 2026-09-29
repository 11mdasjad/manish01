<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'client_name',
        'location',
        'sector',
        'completion_date',
        'budget',
        'scope',
        'challenge',
        'solution',
        'results',
        'featured_image',
        'gallery',
        'is_featured',
        'status',
        'order',
    ];

    protected $casts = [
        'completion_date' => 'date',
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
        if ($this->featured_image && file_exists(public_path('storage/' . $this->featured_image))) {
            return asset('storage/' . $this->featured_image);
        }
        if ($this->featured_image && Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }
        if ($this->featured_image && (Str::startsWith($this->featured_image, ['/images', 'images/']) || file_exists(public_path(ltrim($this->featured_image, '/'))))) {
            return asset(ltrim($this->featured_image, '/'));
        }
        return asset('images/properties/commercial-tower.jpg');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->image_url;
    }

    public static function generateSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', "{$slug}%")->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
