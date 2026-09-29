<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'label',
        'type',
    ];

    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, ?string $value, string $group = 'general', ?string $label = null, string $type = 'text'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'type' => $type,
            ]
        );

        Cache::forget("setting_{$key}");

        return $setting;
    }

    public static function getAllGrouped(): array
    {
        return static::all()->groupBy('group')->toArray();
    }

    /**
     * Get clean numeric digits for telephone and API links.
     */
    public static function getDigits(string $key, string $default = ''): string
    {
        $val = static::get($key, $default) ?? $default;
        $digits = preg_replace('/[^0-9]/', '', $val);
        if (strlen($digits) === 10) {
            $digits = '91' . $digits;
        }
        return $digits;
    }

    /**
     * Generate standard, compliant WhatsApp API URL.
     */
    public static function whatsappUrl(string $key = 'whatsapp_number', ?string $message = null): string
    {
        $phone = static::getDigits($key, '918008007062');
        if (empty($phone)) {
            $phone = '918008007062';
        }

        $defaultMessage = 'Hello Mais Agro House Team, I would like to inquire regarding residential apartments / plots / farmland in Bhubaneswar.';
        $text = rawurlencode($message ?: $defaultMessage);

        return "https://api.whatsapp.com/send?phone={$phone}&text={$text}";
    }
}
