@extends('layouts.admin')

@section('title', 'Détails du participant')

@section('page-title', 'Détails du participant')

@section('page-actions')
<a href="{{ route('admin.participants.edit', $participant->id) }}" class="btn-primary">
    Modifier
</a>
<a href="{{ route('admin.participants.index') }}" class="btn-secondary">
    Retour à la liste
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec informations principales -->
    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-gray-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-16 w-16 rounded-xl flex items-center justify-center mr-4
                    @if($participant->type_formation === 'en_ligne') bg-gradient-to-br from-purple-500 to-purple-600
                    @elseif($participant->type_formation === 'mixte') bg-gradient-to-br from-yellow-500 to-yellow-600
                    @else bg-gradient-to-br from-blue-500 to-blue-600 @endif">
                    @if($participant->type_formation === 'en_ligne')
                    <span class="text-white text-lg font-bold">EN</span>
                    @elseif($participant->type_formation === 'mixte')
                    <span class="text-white text-lg font-bold">MX</span>
                    @else
                    <span class="text-white text-lg font-bold">PR</span>
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $participant->prenom }} {{ $participant->nom }}
                        <span class="text-gray-500 text-lg">#{{ $participant->id }}</span>
                    </h1>
                    <div class="mt-2 flex items-center space-x-4">
                        <!-- Statut -->
                        @php
                        $badgeClass = [
                        'en_attente' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                        'confirme' => 'bg-green-100 text-green-800 border border-green-300',
                        'annule' => 'bg-red-100 text-red-800 border border-red-300',
                        'termine' => 'bg-blue-100 text-blue-800 border border-blue-300',
                        ][$participant->statut] ?? 'bg-gray-100 text-gray-800 border border-gray-300';
                        @endphp
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold {{ $badgeClass }}">
                            {{ ucfirst(str_replace('_', ' ', $participant->statut)) }}
                        </span>

                        <!-- Type formation -->
                        @if($participant->type_formation === 'en_ligne')
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-purple-100 text-purple-800 border border-purple-300">
                            Formation en ligne
                        </span>
                        @elseif($participant->type_formation === 'mixte')
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 border border-yellow-300">
                            Formation mixte
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 border border-blue-300">
                            Formation présentielle
                        </span>
                        @endif

                        <!-- Âge et permis -->
                        @if($participant->age)
                        <span
                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium border border-gray-200">
                            {{ $participant->age }} ans
                        </span>
                        @endif

                        @if($participant->annee_permis)
                        <span
                            class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm font-medium border border-blue-200">
                            {{ $participant->annee_permis }} ans permis
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-gray-900">
                    {{ number_format($participant->formation->price, 0, ',', ' ') }}€
                </div>
                <div class="text-sm text-gray-500 mt-1">Prix de la formation</div>
            </div>
        </div>
    </div>

    <!-- Barre de progression -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between mb-2">
            <div class="text-sm font-medium text-gray-700">Progression de la formation</div>
            <div class="text-sm font-bold text-gray-900">{{ $participant->progression ?? 0 }}%</div>
        </div>
        <div class="h-2.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-green-600 rounded-full transition-all duration-500"
                style="width: {{ $participant->progression ?? 0 }}%"></div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">
        <!-- Colonne gauche -->
        <div class="space-y-6">
            <!-- Informations personnelles -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Informations personnelles
                    </h3>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Nom complet</dt>
                            <dd class="text-base text-gray-900 font-medium">
                                {{ $participant->prenom }} {{ $participant->nom }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Email</dt>
                            <dd class="text-base">
                                <a href="mailto:{{ $participant->email }}"
                                    class="text-blue-700 hover:text-blue-900 font-medium hover:underline">
                                    {{ $participant->email }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Téléphone</dt>
                            <dd class="text-base">
                                @if($participant->telephone)
                                <a href="tel:{{ $participant->telephone }}"
                                    class="text-gray-900 font-medium hover:text-blue-700">
                                    {{ $participant->telephone }}
                                </a>
                                @else
                                <span class="text-gray-400">Non renseigné</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Date de naissance</dt>
                            <dd class="text-base text-gray-900">
                                @if($participant->date_naissance)
                                {{ \Carbon\Carbon::parse($participant->date_naissance)->format('d/m/Y') }}
                                @else
                                <span class="text-gray-400">Non renseignée</span>
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <!-- Adresse -->
                    @if($participant->adresse || $participant->ville || $participant->code_postal)
                    <div class="mt-5 pt-5 border-t border-gray-100">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Adresse</dt>
                        <dd class="text-base text-gray-900">
                            @if($participant->adresse)
                            <div class="mb-1">{{ $participant->adresse }}</div>
                            @endif
                            @if($participant->code_postal || $participant->ville)
                            <div>{{ $participant->code_postal }} {{ $participant->ville }}</div>
                            @endif
                        </dd>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations sur le permis -->
            @if($participant->permis_date || $participant->numero_permis)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Informations permis
                    </h3>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @if($participant->permis_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Date d'obtention</dt>
                            <dd class="text-base text-gray-900">
                                {{ \Carbon\Carbon::parse($participant->permis_date)->format('d/m/Y') }}
                            </dd>
                        </div>
                        @endif
                        @if($participant->annee_permis)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Ancienneté du permis</dt>
                            <dd class="text-base text-gray-900">{{ $participant->annee_permis }} ans</dd>
                        </div>
                        @endif
                        @if($participant->numero_permis)
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Numéro de permis</dt>
                            <dd class="text-base text-gray-900 font-mono p-2 bg-gray-50 rounded border border-gray-200">
                                {{ $participant->numero_permis }}
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
            @endif
        </div>

        <!-- Colonne droite -->
        <div class="space-y-6">
            <!-- Formation -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Formation suivie
                    </h3>
                </div>
                <div class="p-5">
                    <div class="mb-5">
                        <div class="text-sm font-medium text-gray-500 mb-2">Formation</div>
                        <a href="{{ route('admin.formations.show', $participant->formation_id) }}"
                            class="text-xl font-semibold text-purple-700 hover:text-purple-900 hover:underline">
                            {{ $participant->formation->title ?? 'Formation inconnue' }}
                        </a>
                        <p class="mt-2 text-base text-gray-700 leading-relaxed">
                            {{ Str::limit($participant->formation->description ?? 'Aucune description', 180) }}
                        </p>
                    </div>

                    <dl class="grid grid-cols-2 gap-5">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Durée</dt>
                            <dd class="text-base text-gray-900">
                                @if($participant->formation->duration ?? false)
                                {{ $participant->formation->duration }} heures
                                @else
                                <span class="text-gray-400">Non spécifiée</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Niveau</dt>
                            <dd class="text-base text-gray-900">
                                @if($participant->formation->level)
                                @php
                                $levels = [
                                'debutant' => 'Débutant',
                                'intermediaire' => 'Intermédiaire',
                                'avance' => 'Avancé',
                                'expert' => 'Expert'
                                ];
                                @endphp
                                {{ $levels[$participant->formation->level] ?? $participant->formation->level }}
                                @else
                                <span class="text-gray-400">Non spécifié</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Dates importantes -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Dates importantes
                    </h3>
                </div>
                <div class="p-5">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-4 border border-blue-200">
                                    <span class="text-blue-700 text-sm font-bold">I</span>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">Inscription</div>
                                    <div class="text-sm text-gray-600">{{ $participant->created_at->format('d/m/Y à
                                        H:i') }}</div>
                                </div>
                            </div>
                        </div>

                        @if($participant->date_debut)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-4 border border-green-200">
                                    <span class="text-green-700 text-sm font-bold">D</span>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">Début formation</div>
                                    <div class="text-sm text-gray-600">{{
                                        \Carbon\Carbon::parse($participant->date_debut)->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($participant->date_fin)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-4 border border-purple-200">
                                    <span class="text-purple-700 text-sm font-bold">F</span>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">Fin formation</div>
                                    <div class="text-sm text-gray-600">{{
                                        \Carbon\Carbon::parse($participant->date_fin)->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-4 border border-gray-200">
                                    <span class="text-gray-700 text-sm font-bold">M</span>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">Dernière mise à jour</div>
                                    <div class="text-sm text-gray-600">{{ $participant->updated_at->format('d/m/Y à
                                        H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compte utilisateur et paiement -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Informations liées
                    </h3>
                </div>
                <div class="p-5">
                    <!-- Compte utilisateur -->
                    @if($participant->user)
                    <div class="mb-5 pb-5 border-b border-gray-100">
                        <div class="flex items-center mb-3">
                            <div
                                class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3 border border-green-200">
                                <span class="text-green-700 text-xs font-bold">U</span>
                            </div>
                            <div class="text-base font-medium text-gray-700">Compte utilisateur associé</div>
                        </div>
                        <a href="{{ route('admin.users.show', $participant->user_id) }}"
                            class="text-base text-blue-700 hover:text-blue-900 hover:underline font-medium">
                            {{ $participant->user->name }} ({{ $participant->user->email }})
                        </a>
                    </div>
                    @endif

                    <!-- Paiement -->
                    @if($participant->paiement)
                    <div class="mb-5">
                        <div class="flex items-center mb-3">
                            <div
                                class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3 border border-yellow-200">
                                <span class="text-yellow-700 text-xs font-bold">P</span>
                            </div>
                            <div class="text-base font-medium text-gray-700">Paiement associé</div>
                        </div>
                        <a href="{{ route('admin.paiements.show', $participant->paiement_id) }}"
                            class="text-base text-blue-700 hover:text-blue-900 hover:underline font-medium">
                            {{ $participant->paiement->reference ?? 'N/A' }} -
                            {{ number_format($participant->paiement->amount ?? 0, 0, ',', ' ') }} €
                        </a>
                    </div>
                    @endif

                    <!-- Notes -->
                    <div>
                        <div class="flex items-center mb-3">
                            <div
                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3 border border-blue-200">
                                <span class="text-blue-700 text-xs font-bold">N</span>
                            </div>
                            <div class="text-base font-medium text-gray-700">Notes</div>
                        </div>
                        @if($participant->notes)
                        <div
                            class="text-base text-gray-800 bg-gray-50 border border-gray-200 rounded-lg p-4 leading-relaxed">
                            {{ $participant->notes }}
                        </div>
                        @else
                        <p class="text-base text-gray-400 italic">Aucune note</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-base font-semibold text-gray-800">Actions rapides</div>
            <div class="flex items-center space-x-4">
                <!-- Formulaire de changement de statut -->
                <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-sm">
                    <form action="{{ route('admin.participants.update-status', $participant->id) }}" method="POST"
                        class="flex items-center space-x-3">
                        @csrf

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Statut</label>
                            <select name="statut"
                                class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white w-48">
                                <option value="">Changer le statut...</option>
                                <option value="en_attente" {{ $participant->statut == 'en_attente' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="confirme" {{ $participant->statut == 'confirme' ? 'selected' : '' }}>
                                    Confirmé
                                </option>
                                <option value="annule" {{ $participant->statut == 'annule' ? 'selected' : '' }}>
                                    Annulé
                                </option>
                                <option value="termine" {{ $participant->statut == 'termine' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Date début</label>
                            <input type="date" name="date_debut"
                                class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white w-40"
                                value="{{ $participant->date_debut ? \Carbon\Carbon::parse($participant->date_debut)->format('Y-m-d') : '' }}">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Date fin</label>
                            <input type="date" name="date_fin"
                                class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white w-40"
                                value="{{ $participant->date_fin ? \Carbon\Carbon::parse($participant->date_fin)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="pt-5">
                            <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 shadow-sm">
                                Mettre à jour le statut
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Actions secondaires -->
                <div class="flex items-center space-x-3">
                    @if($participant->telephone)
                    <a href="tel:{{ $participant->telephone }}"
                        class="inline-flex items-center px-5 py-2.5 border border-teal-300 text-sm font-semibold rounded-lg text-teal-700 bg-teal-50 hover:bg-teal-100 transition-colors duration-200 shadow-sm"
                        title="Appeler">
                        Appeler
                    </a>
                    @endif

                    <form action="{{ route('admin.participants.destroy', $participant->id) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 border border-red-300 text-sm font-semibold rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce participant ? Cette action est irréversible.')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialisation des tooltips
    $(function () {
        $('[title]').tooltip();

        // Focus sur le select de statut au clic
        $('select[name="statut"]').on('change', function() {
            if ($(this).val()) {
                $(this).next('button').focus();
            }
        });
    });
</script>
@endpush
