@extends('layouts.admin')

@section('title', 'Modifier la Campagne')

@section('page-actions')
<div class="flex space-x-2">
    <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-300">
        <i class="fas fa-eye mr-2"></i> Voir
    </a>
    <a href="{{ route('admin.newsletter.campaigns') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-300">
        <i class="fas fa-arrow-left mr-2"></i> Retour
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Modifier la campagne</h3>
                    <p class="mt-1 text-sm text-gray-500">Modifiez les informations de cette campagne.</p>
                </div>
                <div class="flex items-center space-x-2">
                    @if($campaign->status === 'draft')
                    <span
                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        <i class="fas fa-file-alt mr-1"></i> Brouillon
                    </span>
                    @elseif($campaign->status === 'scheduled')
                    <span
                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i> Planifié
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <form action="{{ route('admin.newsletter.campaigns.update', $campaign) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <!-- Statut info -->
                @if($campaign->status === 'scheduled' && $campaign->scheduled_at)
                <div class="mb-6 p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-yellow-500 mr-3"></i>
                        <div>
                            <p class="font-medium text-yellow-800">Campagne planifiée</p>
                            <p class="text-sm text-yellow-600">Envoi prévu le {{ $campaign->scheduled_at->format('d/m/Y
                                à H:i') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 gap-6">
                    <!-- Sujet -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">
                            Sujet de l'email *
                        </label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject', $campaign->subject) }}"
                            class="mt-1 focus:ring-djok-yellow focus:border-djok-yellow block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('subject') border-red-300 @enderror"
                            required>
                        @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Template -->
                    <div>
                        <label for="template" class="block text-sm font-medium text-gray-700">
                            Template *
                        </label>
                        <select id="template" name="template"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md @error('template') border-red-300 @enderror"
                            required>
                            <option value="default" {{ old('template', $campaign->template) == 'default' ? 'selected' :
                                '' }}>Template par défaut</option>
                            <option value="promotion" {{ old('template', $campaign->template) == 'promotion' ?
                                'selected' : '' }}>Template promotionnel</option>
                            <option value="news" {{ old('template', $campaign->template) == 'news' ? 'selected' : ''
                                }}>Template actualités</option>
                            <option value="event" {{ old('template', $campaign->template) == 'event' ? 'selected' : ''
                                }}>Template événement</option>
                        </select>
                        @error('template')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenu -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">
                            Contenu de l'email *
                        </label>
                        <div class="mt-1">
                            <textarea id="content" name="content" rows="12"
                                class="shadow-sm focus:ring-djok-yellow focus:border-djok-yellow block w-full sm:text-sm border border-gray-300 rounded-md @error('content') border-red-300 @enderror"
                                required>{{ old('content', $campaign->content) }}</textarea>
                        </div>
                        @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Variables disponibles -->
                        <div class="mt-3 p-3 bg-gray-50 rounded-md">
                            <p class="text-sm font-medium text-gray-700 mb-2">Variables disponibles :</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                                <code class="text-xs bg-white p-2 rounded border">{{ '{unsubscribe_url}' }}</code>
                                <code class="text-xs bg-white p-2 rounded border">{{ '{email}' }}</code>
                                <code class="text-xs bg-white p-2 rounded border">{{ '{name}' }}</code>
                            </div>
                        </div>
                    </div>

                    <!-- Programmation (si scheduled) -->
                    @if($campaign->status === 'scheduled')
                    <div>
                        <label for="scheduled_at" class="block text-sm font-medium text-gray-700">
                            Date de programmation
                        </label>
                        <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                            value="{{ old('scheduled_at', $campaign->scheduled_at ? $campaign->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                            min="{{ date('Y-m-d\TH:i') }}"
                            class="mt-1 focus:ring-djok-yellow focus:border-djok-yellow block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('scheduled_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-between">
                @if($campaign->status === 'draft')
                <form action="{{ route('admin.newsletter.campaigns.send', $campaign) }}" method="POST"
                    class="inline-block">
                    @csrf
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        onclick="return confirm('Envoyer cette campagne maintenant ?')">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer maintenant
                    </button>
                </form>
                @elseif($campaign->status === 'scheduled')
                <form action="{{ route('admin.newsletter.campaigns.cancel', $campaign) }}" method="POST"
                    class="inline-block">
                    @csrf
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        onclick="return confirm('Annuler cette campagne ?')">
                        <i class="fas fa-times mr-2"></i> Annuler la campagne
                    </button>
                </form>
                @else
                <div></div>
                @endif

                <div class="flex space-x-3">
                    <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        Annuler
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-save mr-2"></i> Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
