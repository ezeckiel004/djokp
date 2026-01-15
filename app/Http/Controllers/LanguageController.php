<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LocaleHelper;

class LanguageController extends Controller
{
    /**
     * Changer la langue
     */
    public function switch(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:fr,en,es'
        ]);

        $locale = $request->locale;

        // Utiliser notre helper
        LocaleHelper::switchTo($locale);

        return redirect()->back()->with('success', __('common.language_changed'));
    }

    /**
     * Afficher la page de sélection de langue
     */
    public function index()
    {
        return view('language.switch', [
            'locales' => LocaleHelper::availableLocales(),
            'current' => LocaleHelper::currentLocale()
        ]);
    }
}
