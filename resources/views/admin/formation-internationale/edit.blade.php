@extends('layouts.admin')

@section('title', 'Modifier Demande Formation Internationale')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Modifier la demande de {{ $demande->nom_complet }}</h1>
        <a href="{{ route('admin.demandes-formation-internationale.index') }}"
            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Retour
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.demandes-formation-internationale.update', $demande) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations personnelles -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations personnelles</h2>
                </div>

                <div>
                    <label for="nom_complet" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom complet *
                    </label>
                    <input type="text" name="nom_complet" id="nom_complet" required
                        value="{{ old('nom_complet', $demande->nom_complet) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div>
                    <label for="nationalite" class="block text-sm font-medium text-gray-700 mb-2">
                        Nationalité *
                    </label>
                    <input type="text" name="nationalite" id="nationalite" required
                        value="{{ old('nationalite', $demande->nationalite) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" name="email" id="email" required value="{{ old('email', $demande->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                        Téléphone *
                    </label>
                    <input type="text" name="telephone" id="telephone" required
                        value="{{ old('telephone', $demande->telephone) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                        WhatsApp (optionnel)
                    </label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $demande->whatsapp) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <!-- Formation -->
                <div class="md:col-span-2 mt-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Formation demandée</h2>
                </div>

                <div class="md:col-span-2">
                    <label for="formation_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Sélectionner une formation existante
                    </label>
                    <select name="formation_id" id="formation_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">-- Choisir une formation --</option>
                        @foreach($formations as $formation)
                        <option value="{{ $formation->id }}" {{ old('formation_id', $demande->formation_id) ==
                            $formation->id ? 'selected' : '' }}>
                            {{ $formation->title }} ({{ $formation->duration_hours }}h - {{
                            number_format($formation->price, 0, ',', ' ') }} €)
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="formation_personnalisee" class="block text-sm font-medium text-gray-700 mb-2">
                        Ou saisir une formation personnalisée
                    </label>
                    <input type="text" name="formation_personnalisee" id="formation_personnalisee"
                        value="{{ old('formation_personnalisee', $demande->formation_personnalisee) }}"
                        placeholder="Ex: Formation VTC, Formation Marketing Digital..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <!-- Dates -->
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                        Date de début souhaitée (optionnel)
                    </label>
                    <input type="date" name="date_debut" id="date_debut"
                        value="{{ old('date_debut', $demande->date_debut ? $demande->date_debut->format('Y-m-d') : '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div>
                    <label for="duree" class="block text-sm font-medium text-gray-700 mb-2">
                        Durée estimée (optionnel)
                    </label>
                    <select name="duree" id="duree"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">-- Sélectionner --</option>
                        <option value="1-2 semaines" {{ old('duree', $demande->duree) == '1-2 semaines' ? 'selected' :
                            '' }}>1-2 semaines</option>
                        <option value="1 mois" {{ old('duree', $demande->duree) == '1 mois' ? 'selected' : '' }}>1 mois
                        </option>
                        <option value="3 mois" {{ old('duree', $demande->duree) == '3 mois' ? 'selected' : '' }}>3 mois
                        </option>
                        <option value="6 mois" {{ old('duree', $demande->duree) == '6 mois' ? 'selected' : '' }}>6 mois
                        </option>
                        <option value="1 an" {{ old('duree', $demande->duree) == '1 an' ? 'selected' : '' }}>1 an
                        </option>
                    </select>
                </div>

                <!-- Services -->
                <div class="md:col-span-2 mt-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Services demandés</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                        $services = [
                        'Accompagnement visa',
                        'Hébergement',
                        'Transport',
                        'Service conciergerie',
                        'Assurance',
                        'Formation + stage'
                        ];
                        $oldServices = old('services', $demande->services ?? []);
                        @endphp

                        @foreach($services as $service)
                        <label class="flex items-center">
                            <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service,
                                $oldServices) ? 'checked' : '' }}
                                class="mr-2 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                            <span class="text-sm">{{ $service }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Message -->
                <div class="md:col-span-2">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Message / Projet / Besoins spécifiques *
                    </label>
                    <textarea name="message" id="message" rows="6" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Décrivez le projet, les attentes, les besoins spécifiques...">{{ old('message', $demande->message) }}</textarea>
                </div>

                <!-- Statut et Notes -->
                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                        Statut *
                    </label>
                    <select name="statut" id="statut" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="nouveau" {{ old('statut', $demande->statut) == 'nouveau' ? 'selected' : ''
                            }}>Nouveau</option>
                        <option value="en_cours" {{ old('statut', $demande->statut) == 'en_cours' ? 'selected' : ''
                            }}>En cours</option>
                        <option value="traite" {{ old('statut', $demande->statut) == 'traite' ? 'selected' : ''
                            }}>Traité</option>
                        <option value="annule" {{ old('statut', $demande->statut) == 'annule' ? 'selected' : ''
                            }}>Annulé</option>
                    </select>
                </div>

                <div>
                    <label for="notes_admin" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes internes (optionnel)
                    </label>
                    <textarea name="notes_admin" id="notes_admin" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Notes pour le suivi interne...">{{ old('notes_admin', $demande->notes_admin) }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Ces notes seront visibles par le client dans l'email de notification si le statut change.
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.demandes-formation-internationale.show', $demande) }}"
                        class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                        Annuler
                    </a>
                    <button type="submit"
                        class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
