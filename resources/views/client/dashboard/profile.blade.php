@extends('layouts.client')

@section('title', 'Mon Profil')

@section('page-title', 'Mon Profil')
@section('page-description', 'Gérez vos informations personnelles')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Colonne de gauche - Informations profil -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informations personnelles -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Informations personnelles</h3>

                <form action="{{ route('client.profile.update') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet *
                            </label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow"
                                required>
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow"
                                required>
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input type="tel" name="telephone" value="{{ old('telephone', auth()->user()->telephone) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                            @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date de naissance
                            </label>
                            <input type="date" name="date_naissance"
                                value="{{ old('date_naissance', auth()->user()->date_naissance) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse
                        </label>
                        <input type="text" name="adresse" value="{{ old('adresse', auth()->user()->adresse) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Code postal
                            </label>
                            <input type="text" name="code_postal"
                                value="{{ old('code_postal', auth()->user()->code_postal) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <input type="text" name="ville" value="{{ old('ville', auth()->user()->ville) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pays
                            </label>
                            <select name="pays"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow">
                                <option value="France" {{ auth()->user()->pays == 'France' ? 'selected' : '' }}>France
                                </option>
                                <option value="Belgique" {{ auth()->user()->pays == 'Belgique' ? 'selected' : ''
                                    }}>Belgique</option>
                                <option value="Suisse" {{ auth()->user()->pays == 'Suisse' ? 'selected' : '' }}>Suisse
                                </option>
                                <option value="Luxembourg" {{ auth()->user()->pays == 'Luxembourg' ? 'selected' : ''
                                    }}>Luxembourg</option>
                                <!-- Ajoutez d'autres pays au besoin -->
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <button type="submit"
                            class="px-6 py-3 bg-djok-yellow text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-200">
                            Mettre à jour mon profil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mot de passe -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Changer mon mot de passe</h3>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mot de passe actuel
                            </label>
                            <input type="password" name="current_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nouveau mot de passe
                            </label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Confirmer le nouveau mot de passe
                            </label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-djok-yellow focus:border-djok-yellow"
                                required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="px-6 py-3 bg-gray-800 text-white font-medium rounded-lg hover:bg-gray-900 transition-colors duration-200">
                            Changer mon mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Colonne de droite - Avatar et infos -->
        <div class="space-y-6">
            <!-- Avatar -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="mb-4">
                    <div class="inline-block h-32 w-32 rounded-full bg-djok-yellow flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>

                <div class="mt-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Changer la photo
                    </button>
                </div>
            </div>

            <!-- Infos compte -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h4 class="font-medium text-gray-900 mb-4">Informations du compte</h4>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Membre depuis</span>
                        <span class="text-sm font-medium">{{ auth()->user()->created_at->format('d/m/Y') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Dernière connexion</span>
                        <span class="text-sm font-medium">{{ auth()->user()->last_login_at ?
                            auth()->user()->last_login_at->format('d/m/Y H:i') : 'Jamais' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Statut</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Actif
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Rôle</span>
                        <span class="text-sm font-medium">{{ auth()->user()->getRoleNames()->first() ?? 'Client'
                            }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('client.dashboard') }}"
                        class="block text-center px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                        Retour au dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
