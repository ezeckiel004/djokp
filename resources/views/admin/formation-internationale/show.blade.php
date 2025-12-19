@extends('layouts.admin')

@section('title', 'Détail Demande Formation Internationale')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Demande de {{ $demande->nom_complet }}</h1>
            <p class="text-gray-600">Reçue le {{ $demande->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <a href="{{ route('admin.demandes-formation-internationale.index') }}"
            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Retour
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations principales -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informations personnelles -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nom complet</label>
                        <p class="mt-1 text-gray-900">{{ $demande->nom_complet }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nationalité</label>
                        <p class="mt-1 text-gray-900">{{ $demande->nationalite }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <p class="mt-1 text-gray-900">
                            <a href="mailto:{{ $demande->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $demande->email }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                        <p class="mt-1 text-gray-900">
                            <a href="tel:{{ $demande->telephone }}" class="text-blue-600 hover:text-blue-800">
                                {{ $demande->telephone }}
                            </a>
                        </p>
                    </div>
                    @if($demande->whatsapp)
                    <div>
                        <label class="block text-sm font-medium text-gray-500">WhatsApp</label>
                        <p class="mt-1 text-green-600">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $demande->whatsapp) }}"
                                target="_blank" class="hover:text-green-800">
                                {{ $demande->whatsapp }}
                                <i class="fab fa-whatsapp ml-1"></i>
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Formation demandée -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Formation demandée</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-500">Formation</label>
                    <p class="mt-1 text-lg font-medium text-gray-900">
                        {{ $demande->formation_label }}
                    </p>
                </div>

                @if($demande->formation)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-900 mb-2">Détails de la formation :</h3>
                    <p class="text-gray-600">{{ $demande->formation->description }}</p>
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        <div class="text-sm">
                            <span class="text-gray-500">Durée :</span>
                            <span class="font-medium">{{ $demande->formation->duration_hours }}h</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-500">Prix :</span>
                            <span class="font-medium">{{ number_format($demande->formation->price, 0, ',', ' ') }}
                                €</span>
                        </div>
                    </div>
                </div>
                @endif

                @if($demande->date_debut)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-500">Date de début souhaitée</label>
                    <p class="mt-1 text-gray-900">{{ $demande->date_debut->format('d/m/Y') }}</p>
                </div>
                @endif

                @if($demande->duree)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-500">Durée estimée</label>
                    <p class="mt-1 text-gray-900">{{ $demande->duree }}</p>
                </div>
                @endif
            </div>

            <!-- Message et besoins -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Projet et besoins</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 whitespace-pre-line">{{ $demande->message }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar : Statut et Actions -->
        <div class="space-y-6">
            <!-- Statut -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statut de la demande</h2>
                <div class="mb-4">
                    <span
                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $demande->statut_color }}">
                        {{ $demande->statut_label }}
                    </span>
                </div>

                <!-- FORMULAIRE MODIFIÉ : Utilise la nouvelle route update-statut -->
                <form action="{{ route('admin.demandes-formation-internationale.update-statut', $demande) }}"
                    method="POST">
                    @csrf


                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Changer le statut</label>
                        <select name="statut"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="nouveau" {{ $demande->statut == 'nouveau' ? 'selected' : '' }}>Nouveau
                            </option>
                            <option value="en_cours" {{ $demande->statut == 'en_cours' ? 'selected' : '' }}>En cours
                            </option>
                            <option value="traite" {{ $demande->statut == 'traite' ? 'selected' : '' }}>Traité</option>
                            <option value="annule" {{ $demande->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes internes</label>
                        <textarea name="notes_admin" rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="Ajoutez des notes pour le suivi...">{{ old('notes_admin', $demande->notes_admin) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">
                            Ces notes seront visibles par le client dans l'email de notification.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Mettre à jour
                    </button>

                    <p class="text-xs text-gray-500 mt-2 text-center">
                        Un email sera automatiquement envoyé au client si le statut change.
                    </p>
                </form>
            </div>

            <!-- Services demandés -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Services demandés</h2>
                @if($demande->services && count($demande->services) > 0)
                <ul class="space-y-2">
                    @foreach($demande->services as $service)
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>{{ $service }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-gray-500 italic">Aucun service spécifique demandé</p>
                @endif
            </div>

            <!-- Actions rapides -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h2>
                <div class="space-y-3">
                    <a href="mailto:{{ $demande->email }}?subject=Réponse à votre demande de formation internationale"
                        class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-envelope mr-2"></i>Envoyer un email
                    </a>

                    @if($demande->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $demande->whatsapp) }}" target="_blank"
                        class="block w-full text-center bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        <i class="fab fa-whatsapp mr-2"></i>Contacter sur WhatsApp
                    </a>
                    @endif

                    <form action="{{ route('admin.demandes-formation-internationale.destroy', $demande) }}"
                        method="POST" onsubmit="return confirm('Supprimer définitivement cette demande ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full text-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i>Supprimer la demande
                        </button>
                    </form>

                    <!-- Lien vers l'édition -->
                    <a href="{{ route('admin.demandes-formation-internationale.edit', $demande) }}"
                        class="block w-full text-center bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                        <i class="fas fa-edit mr-2"></i>Modifier toutes les informations
                    </a>
                </div>
            </div>

            <!-- Informations techniques -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informations techniques</h2>
                <div class="space-y-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">ID de la demande</label>
                        <p class="mt-1 text-gray-900">#{{ $demande->id }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Date de création</label>
                        <p class="mt-1 text-gray-900">{{ $demande->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Dernière mise à jour</label>
                        <p class="mt-1 text-gray-900">{{ $demande->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Formation ID</label>
                        <p class="mt-1 text-gray-900">
                            @if($demande->formation_id)
                            {{ $demande->formation_id }} ({{ $demande->formation->title ?? 'N/A' }})
                            @else
                            Formation personnalisée
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des modifications (optionnel) -->
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Historique des modifications</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Champ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ancienne valeur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nouvelle valeur</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                    $history = [
                    ['date' => $demande->created_at->format('d/m/Y H:i'), 'champ' => 'Création', 'ancien' => '-',
                    'nouveau' => 'Demande créée'],
                    ];

                    if($demande->created_at != $demande->updated_at) {
                    $history[] = [
                    'date' => $demande->updated_at->format('d/m/Y H:i'),
                    'champ' => 'Mise à jour',
                    'ancien' => '-',
                    'nouveau' => 'Dernière modification'
                    ];
                    }
                    @endphp

                    @foreach($history as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['date'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['champ'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['ancien'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['nouveau'] }}</td>
                    </tr>
                    @endforeach

                    @if(count($history) == 1)
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucune autre modification enregistrée
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Confirmation avant suppression
    document.querySelectorAll('form[onsubmit]').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette demande ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });

    // Notification lorsque le statut change
    const statutSelect = document.querySelector('select[name="statut"]');
    const currentStatut = "{{ $demande->statut }}";

    if (statutSelect) {
        statutSelect.addEventListener('change', function() {
            if (this.value !== currentStatut) {
                const statutLabels = {
                    'nouveau': 'Nouveau',
                    'en_cours': 'En cours',
                    'traite': 'Traité',
                    'annule': 'Annulé'
                };

                const ancien = statutLabels[currentStatut] || currentStatut;
                const nouveau = statutLabels[this.value] || this.value;

                if (confirm(`Le statut va passer de "${ancien}" à "${nouveau}". Un email sera envoyé au client. Continuer ?`)) {
                    return true;
                } else {
                    this.value = currentStatut;
                    return false;
                }
            }
        });
    }
</script>
@endpush
