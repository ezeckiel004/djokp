@extends('layouts.admin')

@section('title', 'Modifier un participant')

@section('page-title', 'Modifier un participant')

@section('page-actions')
<a href="{{ route('admin.participants.show', $participant->id) }}" class="btn-secondary mr-2">
    <i class="fas fa-eye mr-2"></i>Voir les détails
</a>
<a href="{{ route('admin.participants.index') }}" class="btn-secondary">
    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
</a>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <!-- En-tête -->
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">
                        <i class="fas fa-user-edit text-blue-600 mr-2"></i>
                        Modifier {{ $participant->nom_complet }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Modifiez les informations du participant
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $participant->statut == 'confirme' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        <i class="fas fa-{{ $participant->statut == 'confirme' ? 'check-circle' : 'clock' }} mr-1"></i>
                        {{ $participant->statut_readable }}
                    </span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $participant->type_formation == 'en_ligne' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        <i
                            class="fas fa-{{ $participant->type_formation == 'en_ligne' ? 'laptop' : 'users' }} mr-1"></i>
                        {{ $participant->type_formation_readable }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.participants.update', $participant->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Section 1: Informations personnelles -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h4 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </span>
                            Informations personnelles
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="nom" value="{{ old('nom', $participant->nom) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Prénom <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="prenom" value="{{ old('prenom', $participant->prenom) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $participant->email) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input type="tel" name="telephone" value="{{ old('telephone', $participant->telephone) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse
                            </label>
                            <input type="text" name="adresse" value="{{ old('adresse', $participant->adresse) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Code postal
                            </label>
                            <input type="text" name="code_postal"
                                value="{{ old('code_postal', $participant->code_postal) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <input type="text" name="ville" value="{{ old('ville', $participant->ville) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Dates importantes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date de naissance
                            </label>
                            <input type="date" name="date_naissance"
                                value="{{ old('date_naissance', $participant->date_naissance?->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date du permis
                            </label>
                            <input type="date" name="permis_date"
                                value="{{ old('permis_date', $participant->permis_date?->format('Y-m-d')) }}"
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
                            Formation et suivi
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Formation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Formation <span class="text-red-600">*</span>
                            </label>
                            <select name="formation_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @foreach($formations as $formation)
                                <option value="{{ $formation->id }}" {{ old('formation_id', $participant->formation_id)
                                    == $formation->id ? 'selected' : '' }}>
                                    {{ $formation->title }} - {{ number_format($formation->price, 0, ',', ' ') }} €
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type de formation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Type de formation <span class="text-red-600">*</span>
                            </label>
                            <select name="type_formation" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="presentiel" {{ old('type_formation', $participant->type_formation) ==
                                    'presentiel' ? 'selected' : '' }}>Présentiel</option>
                                <option value="en_ligne" {{ old('type_formation', $participant->type_formation) ==
                                    'en_ligne' ? 'selected' : '' }}>En ligne</option>
                                <option value="mixte" {{ old('type_formation', $participant->type_formation) == 'mixte'
                                    ? 'selected' : '' }}>Mixte</option>
                            </select>
                        </div>

                        <!-- Statut -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Statut <span class="text-red-600">*</span>
                            </label>
                            <select name="statut" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="en_attente" {{ old('statut', $participant->statut) == 'en_attente' ?
                                    'selected' : '' }}>En attente</option>
                                <option value="confirme" {{ old('statut', $participant->statut) == 'confirme' ?
                                    'selected' : '' }}>Confirmé</option>
                                <option value="annule" {{ old('statut', $participant->statut) == 'annule' ? 'selected' :
                                    '' }}>Annulé</option>
                                <option value="termine" {{ old('statut', $participant->statut) == 'termine' ? 'selected'
                                    : '' }}>Terminé</option>
                            </select>
                        </div>

                        <!-- Progression -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Progression (%)
                            </label>
                            <input type="number" name="progression"
                                value="{{ old('progression', $participant->progression) }}" min="0" max="100" step="0.1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Dates de formation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date de début
                            </label>
                            <input type="date" name="date_debut"
                                value="{{ old('date_debut', $participant->date_debut?->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date de fin
                            </label>
                            <input type="date" name="date_fin"
                                value="{{ old('date_fin', $participant->date_fin?->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Associer à un utilisateur -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Associer à un utilisateur
                            </label>
                            <select name="user_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Aucun</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $participant->user_id) == $user->id ?
                                    'selected' : '' }}>
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
                            placeholder="Informations complémentaires, remarques...">{{ old('notes', $participant->notes) }}</textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.participants.show', $participant->id) }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection