<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LocaleHelper
{
    /**
     * Generate a localized URL
     */
    public static function route(string $name, ?string $locale = null, array $parameters = []): string    {
        $locale = $locale ?? App::getLocale();
        
        // Si estamos ocultando el idioma por defecto en URL
        if (config('locales.hide_default_in_url') && $locale === config('locales.default')) {
            return route($name, $parameters);
        }
        
        return route($name, array_merge(['locale' => $locale], $parameters));
    }

    /**
     * Get available locales
     */
    public static function available(): array
    {
        return config('locales.available', []);
    }

    /**
     * Get current locale info
     */
    public static function current(): array
    {
        $locale = App::getLocale();
        return config("locales.available.{$locale}", []);
    }

    /**
     * Get alternate locale (opposite of current)
     */
    public static function alternate(): string
    {
        return App::getLocale() === 'es' ? 'en' : 'es';
    }
}