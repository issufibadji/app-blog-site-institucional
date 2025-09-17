<?php

namespace App\Support;

use Illuminate\Support\Str;

class TextSanitizer
{
    /**
     * Words that should be removed from generated lorem text.
     */
    protected static array $forbidden = [
        'sapiente',
        'non',
        'sit',
        'nobis',
        'officiis',
        'ut',
    ];

    /**
     * Remove the configured forbidden words from the provided text.
     */
    public static function removeForbiddenWords(string $text): string
    {
        if ($text === '') {
            return $text;
        }

        $pattern = '/\\b(' . implode('|', array_map('preg_quote', self::$forbidden)) . ')\\b/i';
        $cleaned = preg_replace($pattern, '', $text) ?? $text;

        $cleaned = preg_replace('/\s{2,}/', ' ', $cleaned) ?? $cleaned;
        $cleaned = preg_replace('/\s+([,.;!?])/', '$1', $cleaned) ?? $cleaned;

        return trim($cleaned);
    }

    /**
     * Generate sanitized text using the provided generator.
     */
    public static function sanitizedFrom(callable $generator, int $attempts = 5, ?string $fallback = null): string
    {
        for ($i = 0; $i < $attempts; $i++) {
            $value = self::removeForbiddenWords((string) $generator());

            if ($value !== '') {
                return $value;
            }
        }

        $fallbackValue = $fallback ?? 'placeholder-' . Str::random(8);

        return self::removeForbiddenWords($fallbackValue);
    }
}
