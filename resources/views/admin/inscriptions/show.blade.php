@extends('layouts.admin')

@section('title', 'Inscription #' . $inscription->id)

@section('page-title', 'Détails de l\'inscription')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Inscription #{{ $inscription->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Créée le {{ $inscription->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span
                    class="badge {{ $inscription->status == 'pending' ? 'badge-warning' : ($inscription->status == 'confirmed' ? 'badge-info' : ($inscription->status == 'in_progress' ? 'badge-primary' : ($inscription->status == 'completed' ? 'badge-success' : 'badge-danger'))) }}">
                    {{ $statuses[$inscription->status] }}
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.inscriptions.edit', $inscription) }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informations étudiant -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations étudiant</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom complet</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->phone ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de naissance</p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $inscription->user->birth_date ? $inscription->user->birth_date->format('d/m/Y') : 'Non
                            renseigné' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations formation -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations formation</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Formation</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">{{ $inscription->formation->title }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $inscription->formation->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Prix formation</p>
                        <p class="mt-1 text-sm text-gray-900">{{ number_format($inscription->formation->price, 2) }}€
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Description</p>
                        <p class="mt-1 text-sm text-gray-900">{{ Str::limit($inscription->formation->description, 200)
                            }}</p>
                    </div>
                </div>
            </div>

            <!-- Dates et statut -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Dates et statut</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Statut</p>
                        <span
                            class="mt-1 inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $inscription->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($inscription->status == 'confirmed' ? 'bg-blue-100 text-blue-800' : ($inscription->status == 'in_progress' ? 'bg-purple-100 text-purple-800' : ($inscription->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'))) }}">
                            {{ $statuses[$inscription->status] }}
                        </span>
                    </div>
                    @if($inscription->start_date)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de début</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->start_date->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    @if($inscription->end_date)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de fin</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->end_date->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">Durée totale</p>
                        <p class="mt-1 text-sm text-gray-900">
                            @if($inscription->start_date && $inscription->end_date)
                            {{ $inscription->start_date->diffInDays($inscription->end_date) + 1 }} jours
                            @else
                            Non définie
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations financières -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations financières</h4>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <p class="text-sm font-medium text-gray-500">Montant total formation</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($inscription->formation->price, 2)
                            }}€</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm font-medium text-gray-500">Montant déjà payé</p>
                        <p class="text-sm font-medium text-green-600">{{ number_format($inscription->amount_paid, 2) }}€
                        </p>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <p class="text-sm font-medium text-gray-500">Reste à payer</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($inscription->formation->price -
                            $inscription->amount_paid, 2) }}€</p>
                    </div>
                    @if($inscription->payment_method)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Méthode de paiement</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $paymentMethods[$inscription->payment_method] ??
                            $inscription->payment_method }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Transfert de formation -->
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Transfert de formation</h4>
                <form action="{{ route('admin.inscriptions.transfer', $inscription) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir transférer cette inscription vers une autre formation ?')">
                    @csrf
                    <div class="flex items-end gap-4">
                        <div class="flex-1">
                            <label for="new_formation_id" class="block text-sm font-medium text-gray-700">
                                Nouvelle formation
                            </label>
                            <select name="new_formation_id" id="new_formation_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                                <option value="">Sélectionner une nouvelle formation</option>
                                @foreach($formations as $formation)
                                <option value="{{ $formation->id }}">
                                    {{ $formation->title }} - {{ $formation->type }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <i class="fas fa-exchange-alt mr-2"></i> Transférer
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Le statut sera réinitialisé à "En attente" après le transfert.
                    </p>
                </form>
            </div>

            <!-- Notes -->
            @if($inscription->notes)
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Notes</h4>
                <div class="bg-white rounded border p-4">
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $inscription->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <a href="{{ route('admin.inscriptions.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Bouton Certificat -->
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-certificate mr-2"></i> Générer certificat
                </button>

                <!-- Bouton Facture -->
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-invoice mr-2"></i> Générer facture
                </button>

                <!-- Bouton Supprimer -->
                <form action="{{ route('admin.inscriptions.destroy', $inscription) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
