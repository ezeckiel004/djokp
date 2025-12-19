@extends('layouts.admin')

@section('title', 'Message de ' . $contact->nom)

@section('page-title', 'Message reçu')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Message #{{ $contact->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <!-- Badge statut -->
                @if(!$contact->is_read)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                    <i class="fas fa-envelope mr-2"></i>Non lu
                </span>
                @elseif($contact->is_replied)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                    <i class="fas fa-check-circle mr-2"></i>Répondu
                </span>
                @else
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                    <i class="fas fa-eye mr-2"></i>Lu non répondu
                </span>
                @endif

                <!-- Bouton Répondre -->
                <a href="mailto:{{ $contact->email }}?subject=Réponse à votre demande #{{ $contact->id }}"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-reply mr-2"></i> Répondre
                </a>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Informations expéditeur -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Expéditeur</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom complet</p>
                        <div class="mt-1 flex items-center">
                            <div
                                class="h-12 w-12 rounded-full {{ !$contact->is_read ? 'bg-red-500' : 'bg-gray-400' }} flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-lg">
                                    {{ strtoupper(substr($contact->nom, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-gray-900">{{ $contact->nom }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900 break-all">
                            <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-envelope mr-2"></i>{{ $contact->email }}
                            </a>
                        </p>
                    </div>
                    @if($contact->telephone)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="tel:{{ $contact->telephone }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-phone mr-2"></i>{{ $contact->telephone }}
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Service et métadonnées -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Détails de la demande</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Service demandé</p>
                        @if($contact->service)
                        <div class="mt-1 flex items-center">
                            <div class="h-8 w-8 rounded-full flex items-center justify-center mr-2"
                                style="color: {{ $contact->service->color ?? '#667eea' }}">
                                {!! $contact->service->icon_html ?? '<i class="fas fa-cog"></i>' !!}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $contact->service->name }}</p>
                            </div>
                        </div>
                        @elseif($contact->autre_service)
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                            {{ $contact->autre_service }}
                        </p>
                        @else
                        <p class="mt-1 text-sm text-gray-400 italic">Non spécifié</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Envoyé le</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                            {{ $contact->created_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                    @if($contact->replied_at)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Répondu le</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-reply-all mr-2 text-gray-400"></i>
                            {{ $contact->replied_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dernière mise à jour</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-sync-alt mr-2 text-gray-400"></i>
                            {{ $contact->updated_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Gestion du statut -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Gestion</h4>
                <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="is_read" id="is_read" value="1" {{ $contact->is_read ?
                                'checked' : '' }}
                                class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded">
                                <span class="text-sm font-medium text-gray-700">Marquer comme lu</span>
                            </label>
                        </div>

                        <div>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="is_replied" id="is_replied" value="1" {{
                                    $contact->is_replied ? 'checked' : '' }}
                                class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded">
                                <span class="text-sm font-medium text-gray-700">Marquer comme répondu</span>
                            </label>
                        </div>

                        @if($contact->is_replied)
                        <div>
                            <label for="replied_at" class="block text-sm font-medium text-gray-700">
                                Date de réponse
                            </label>
                            <input type="datetime-local" name="replied_at" id="replied_at"
                                value="{{ old('replied_at', $contact->replied_at ? $contact->replied_at->format('Y-m-d\TH:i') : '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow sm:text-sm">
                        </div>
                        @endif

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                <i class="fas fa-save mr-2"></i> Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Message complet -->
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Message</h4>
                <div class="bg-white rounded-lg border p-6">
                    <div class="prose max-w-none">
                        <p class="text-gray-900 whitespace-pre-line leading-relaxed">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>

            <!-- Réponse et notes -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Réponse envoyée</h4>
                <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_reply" value="1">

                    <div>
                        <textarea name="reply_message" id="reply_message" rows="10"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow sm:text-sm"
                            placeholder="Contenu de la réponse envoyée...">{{ old('reply_message', $contact->reply_message) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Cette réponse sera stockée pour référence future.
                        </p>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit"
                            class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-save mr-2"></i> Enregistrer
                        </button>

                        <a href="mailto:{{ $contact->email }}?subject=Réponse à votre demande #{{ $contact->id }}&body=Bonjour {{ $contact->nom }}%0D%0A%0D%0AVoici notre réponse à votre demande :%0D%0A%0D%0A{{ urlencode($contact->reply_message ?? '') }}"
                            target="_blank"
                            class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                            <i class="fas fa-envelope mr-2"></i> Ouvrir email
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <a href="{{ route('admin.contacts.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Bouton Répondre par email -->
                <a href="mailto:{{ $contact->email }}?subject=Réponse à votre demande #{{ $contact->id }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-reply mr-2"></i> Répondre par email
                </a>

                <!-- Bouton Marquer comme lu -->
                @if(!$contact->is_read)
                <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_read" value="1">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-eye mr-2"></i> Marquer comme lu
                    </button>
                </form>
                @endif

                <!-- Bouton Supprimer -->
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.');">
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

@push('styles')
<style>
    .prose {
        max-width: none;
    }

    .prose p {
        margin-top: 0;
        margin-bottom: 1em;
    }

    .prose p:last-child {
        margin-bottom: 0;
    }

    .break-all {
        word-break: break-all;
    }
</style>
@endpush
