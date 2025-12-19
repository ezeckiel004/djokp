<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Afficher le formulaire d'édition du profil
     */
    public function edit()
    {
        $user = Auth::user();

        return view('client.profile.edit', compact('user'));
    }

    /**
     * Mettre à jour le profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        $user->update($validated);

        return redirect()->route('client.profile.edit')
            ->with('success', 'Profil mis à jour avec succès!');
    }

    /**
     * Mettre à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('client.profile.edit')
            ->with('success', 'Mot de passe mis à jour avec succès!');
    }

    /**
     * Afficher les paramètres
     */
    public function settings()
    {
        $user = Auth::user();

        return view('client.settings.index', compact('user'));
    }

    /**
     * Mettre à jour les paramètres
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'newsletter' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('client.settings')
            ->with('success', 'Paramètres mis à jour avec succès!');
    }
}
