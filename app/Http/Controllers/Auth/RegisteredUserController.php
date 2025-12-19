<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration view.
     */
    public function create(): RedirectResponse
    {
        // Rediriger vers l'espace client
        return redirect()->route('espaceclient');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'birth_date' => ['nullable', 'date'],
            'cni_number' => ['nullable', 'string', 'max:50'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'newsletter' => ['nullable', 'boolean'],
        ]);

        // Vérifier que le rôle client existe (ID 5 selon votre seeder)
        $clientRole = Role::find(5);

        if (!$clientRole) {
            throw ValidationException::withMessages([
                'role' => ['Le rôle client n\'existe pas. Veuillez contacter l\'administrateur.'],
            ]);
        }

        // Préparer les données de l'utilisateur
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id, // ID 5 pour client
            'is_active' => true,
            'newsletter' => $request->boolean('newsletter') ?? false,
        ];

        // Ajouter les champs optionnels s'ils sont présents
        $optionalFields = [
            'phone',
            'address',
            'city',
            'country',
            'birth_date',
            'cni_number',
            'driver_license'
        ];

        foreach ($optionalFields as $field) {
            if ($request->filled($field)) {
                $userData[$field] = $request->$field;
            }
        }

        // Créer l'utilisateur
        $user = User::create($userData);

        // Déclencher l'événement d'enregistrement
        event(new Registered($user));

        // Connecter l'utilisateur
        Auth::login($user);

        // Mettre à jour la dernière connexion
        $user->last_login_at = now();
        $user->save();

        // Rediriger vers le dashboard approprié
        return $this->redirectToDashboard($user);
    }

    /**
     * Rediriger l'utilisateur vers le dashboard approprié selon son rôle
     */
    private function redirectToDashboard(User $user): RedirectResponse
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Bienvenue administrateur !');
        } elseif ($user->hasRole('chauffeur')) {
            return redirect()->route('chauffeur.dashboard')
                ->with('success', 'Bienvenue chauffeur !');
        } elseif ($user->hasRole('formateur')) {
            return redirect()->route('formateur.dashboard')
                ->with('success', 'Bienvenue formateur !');
        } else {
            // Par défaut, rediriger vers le dashboard client
            return redirect()->route('client.dashboard')
                ->with('success', 'Bienvenue sur votre espace client !');
        }
    }
}
