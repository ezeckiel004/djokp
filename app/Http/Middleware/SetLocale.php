<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Helpers\LocaleHelper;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Vérifier si une langue est définie dans la session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        // 2. Sinon, vérifier si une langue est définie dans l'URL
        elseif ($request->has('lang')) {
            $locale = $request->get('lang');
        }
        // 3. Sinon, détecter la langue du navigateur
        else {
            $locale = $this->detectBrowserLanguage($request);
        }

        // S'assurer que la langue est valide
        $locales = LocaleHelper::availableLocales();
        if (!array_key_exists($locale, $locales)) {
            $locale = config('app.fallback_locale');
        }

        // Définir la locale
        App::setLocale($locale);

        // Partager avec toutes les vues
        view()->share('currentLocale', LocaleHelper::currentLocale());
        view()->share('availableLocales', $locales);

        return $next($request);
    }

    /**
     * Détecter la langue du navigateur
     */
    private function detectBrowserLanguage(Request $request)
    {
        $browserLocale = $request->getPreferredLanguage(['fr', 'en', 'es']);
        return $browserLocale ?: config('app.fallback_locale');
    }
}
