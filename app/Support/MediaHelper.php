<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Resolve any image path, relative path, storage path, or absolute URL to a fully usable public URL.
     */
    public static function resolve(?string $path, ?string $fallback = null): string
    {
        $defaultFallback = $fallback
            ? (Str::startsWith($fallback, ['http://', 'https://']) ? $fallback : asset(ltrim($fallback, '/')))
            : asset('images/properties/residential-plots.jpg');

        if (empty($path)) {
            return $defaultFallback;
        }

        // Already full URL or Data URI
        if (Str::startsWith($path, ['http://', 'https://', 'data:', '//'])) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');

        // If explicitly prefixed with storage/
        if (Str::startsWith($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        // Check if exists in public storage disk (e.g. 'products/abc.jpg', 'services/xyz.jpg')
        if (Storage::disk('public')->exists($cleanPath)) {
            return asset('storage/'.$cleanPath);
        }

        // Check if file exists in public/ directly (e.g. 'images/properties/residential-plots.jpg')
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // Check if symlinked in public/storage
        if (file_exists(public_path('storage/'.$cleanPath))) {
            return asset('storage/'.$cleanPath);
        }

        // If it starts with images/, return asset
        if (Str::startsWith($cleanPath, ['images/', 'img/', 'assets/', 'videos/'])) {
            return asset($cleanPath);
        }

        // If it has an image extension, default to public storage URL
        if (preg_match('/\.(jpg|jpeg|png|webp|gif|svg)$/i', $cleanPath)) {
            return asset('storage/'.$cleanPath);
        }

        return $defaultFallback;
    }
}
