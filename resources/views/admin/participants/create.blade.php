@extends('layouts.admin')

@section('title', 'Ajouter un participant')

@section('page-title', 'Ajouter un participant')

@section('page-actions')
<a href="{{ route('admin.participants.index') }}" class="btn-secondary">
    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
</a>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <!-- En-tête -->
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                <i class="fas fa-user-plus text-blue-600 mr-2"></i>
                Nouveau participant
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                Remplissez le formulaire ci-dessous pour inscrire un nouveau participant à une formation.
            </p>
        </div>

        <!-- Formulaire -->
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.participants.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section 1: Informations personnelles -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h4 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </span>
                            Informations personnelles
                        </h4>
                        <p class="mt-1 text-sm text-gray-600">
                            Informations de base du participant
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nom') border-red-500 @enderror"
                                placeholder="Dupont">
                            @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Prénom <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('prenom') border-red-500 @enderror"
                                placeholder="Jean">
                            @error('prenom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                placeholder="jean.dupont@email.com">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input type="tel" name="telephone" value="{{ old('telephone') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('telephone') border-red-500 @enderror"
                                placeholder="+33 1 23 45 67 89">
                            @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse
                            </label>
                            <input type="text" name="adresse" value="{{ old('adresse') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="123 Avenue des Champs-Élysées">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Code postal
                            </label>
                            <input type="text" name="code_postal" value="{{ old('code_postal') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="75008">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <input type="text" name="ville" value="{{ old('ville') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Paris">
                        </div>
                    </div>

                    <!-- Dates importantes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date de naissance
                            </label>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date du permis
                            </label>
                            <input type="date" name="permis_date" value="{{ old('permis_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Formation -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h4 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-graduation-cap text-green-600"></i>
                            </span>
                            Formation
                        </h4>
                        <p class="mt-1 text-sm text-gray-600">
                            Sélectionnez la formation et configurez l'inscription
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Formation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Formation <span class="text-red-600">*</span>
                            </label>
                            <select name="formation_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('formation_id') border-red-500 @enderror">
                                <option value="">Sélectionnez une formation</option>
                                @foreach($formations as $formation)
                                <option value="{{ $formation->id }}" {{ old('formation_id')==$formation->id ? 'selected'
                                    : '' }}>
                                    {{ $formation->title }} - {{ number_format($formation->price, 0, ',', ' ') }} €
                                </option>
                                @endforeach
                            </select>
                            @error('formation_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type de formation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Type de formation <span class="text-red-600">*</span>
                            </label>
                            <select name="type_formation" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Sélectionnez un type</option>
                                <option value="presentiel" {{ old('type_formation')=='presentiel' ? 'selected' : '' }}>
                                    Présentiel</option>
                                <option value="en_ligne" {{ old('type_formation')=='en_ligne' ? 'selected' : '' }}>En
                                    ligne</option>
                                <option value="mixte" {{ old('type_formation')=='mixte' ? 'selected' : '' }}>Mixte
                                </option>
                            </select>
                        </div>

                        <!-- Statut -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Statut <span class="text-red-600">*</span>
                            </label>
                            <select name="statut" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="en_attente" {{ old('statut')=='en_attente' ? 'selected' : '' }}>En
                                    attente</option>
                                <option value="confirme" {{ old('statut')=='confirme' ? 'selected' : '' }}>Confirmé
                                </option>
                                <option value="annule" {{ old('statut')=='annule' ? 'selected' : '' }}>Annulé</option>
                                <option value="termine" {{ old('statut')=='termine' ? 'selected' : '' }}>Terminé
                                </option>
                            </select>
                        </div>

                        <!-- Associer à un utilisateur -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Associer à un utilisateur existant
                            </label>
                            <select name="user_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Aucun (inscription directe)</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id')==$user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Notes internes
                        </label>
                        <textarea name="notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Informations complémentaires, remarques...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.participants.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Enregistrer le participant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection