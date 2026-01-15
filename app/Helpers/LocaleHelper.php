<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LocaleHelper
{
    /**
     * Obtenir la liste des langues disponibles avec leurs noms
     */
    public static function availableLocales()
    {
        return [
            'fr' => [
                'code' => 'fr',
                'name' => 'Français',
                'flag' => '🇫🇷',
                'short' => 'FR'
            ],
            'en' => [
                'code' => 'en',
                'name' => 'English',
                'flag' => '🇬🇧',
                'short' => 'EN'
            ],
            'es' => [
                'code' => 'es',
                'name' => 'Español',
                'flag' => '🇪🇸',
                'short' => 'ES'
            ],
        ];
    }

    /**
     * Obtenir les infos de la locale actuelle
     */
    public static function currentLocale()
    {
        $locales = self::availableLocales();
        return $locales[App::getLocale()] ?? $locales['fr'];
    }

    /**
     * Basculer vers une autre langue
     */
    public static function switchTo($locale)
    {
        if (array_key_exists($locale, self::availableLocales())) {
            session(['locale' => $locale]);
            App::setLocale($locale);
            return true;
        }
        return false;
    }
}
