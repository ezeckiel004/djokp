@extends('layouts.admin')

@section('title', 'Nouvelle Campagne Newsletter')

@section('page-actions')
<a href="{{ route('admin.newsletter.campaigns') }}"
    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-300">
    <i class="fas fa-arrow-left mr-2"></i> Retour
</a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Nouvelle campagne newsletter</h3>
            <p class="mt-1 text-sm text-gray-500">Créez une nouvelle campagne à envoyer à vos abonnés.</p>
        </div>

        <form action="{{ route('admin.newsletter.campaigns.store') }}" method="POST">
            @csrf
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <!-- Destinataires -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-users text-blue-500 mr-3"></i>
                        <div>
                            <p class="font-medium text-blue-800">{{ $activeSubscribers }} abonnés actifs</p>
                            <p class="text-sm text-blue-600">Cette campagne sera envoyée à tous vos abonnés actifs.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Sujet -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">
                            Sujet de l'email *
                        </label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
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
                            <option value="">Sélectionnez un template</option>
                            <option value="default" {{ old('template')=='default' ? 'selected' : '' }}>Template par
                                défaut</option>
                            <option value="promotion" {{ old('template')=='promotion' ? 'selected' : '' }}>Template
                                promotionnel</option>
                            <option value="news" {{ old('template')=='news' ? 'selected' : '' }}>Template actualités
                            </option>
                            <option value="event" {{ old('template')=='event' ? 'selected' : '' }}>Template événement
                            </option>
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
                                placeholder="Rédigez votre contenu ici... Vous pouvez utiliser du HTML."
                                required>{{ old('content') }}</textarea>
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
                            <p class="text-xs text-gray-500 mt-2">Ces variables seront remplacées automatiquement pour
                                chaque destinataire.</p>
                        </div>
                    </div>

                    <!-- Programmation -->
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="send_immediately" name="send_immediately" type="checkbox" value="1" {{
                                    old('send_immediately') ? 'checked' : '' }}
                                    class="focus:ring-djok-yellow h-4 w-4 text-djok-yellow border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="send_immediately" class="font-medium text-gray-700">Envoyer
                                    immédiatement</label>
                                <p class="text-gray-500">La campagne sera envoyée dès sa création.</p>
                            </div>
                        </div>

                        <!-- Champ de programmation (caché si "envoyer immédiatement" est coché) -->
                        <div id="scheduleField"
                            style="{{ old('send_immediately') ? 'display: none;' : 'display: block;' }}">
                            <label for="scheduled_at" class="block text-sm font-medium text-gray-700">
                                Programmer pour plus tard
                            </label>
                            <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                                value="{{ old('scheduled_at') }}" min="{{ date('Y-m-d\TH:i') }}"
                                class="mt-1 focus:ring-djok-yellow focus:border-djok-yellow block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-xs text-gray-500">Laissez vide si vous ne voulez pas programmer.</p>
                            @error('scheduled_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-end space-x-3">
                <a href="{{ route('admin.newsletter.campaigns') }}"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    Annuler
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-save mr-2"></i> Créer la campagne
                </button>
            </div>
        </form>
    </div>

    <!-- Conseils -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Conseils pour réussir votre campagne</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
            <ul class="space-y-3">
                <li class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                    <span class="text-sm text-gray-700"><strong>Sujet clair :</strong> Rédigez un sujet court et
                        accrocheur</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                    <span class="text-sm text-gray-700"><strong>Contenu structuré :</strong> Utilisez des titres et des
                        paragraphes courts</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                    <span class="text-sm text-gray-700"><strong>Appel à l'action :</strong> Ajoutez des boutons clairs
                        pour guider vos lecteurs</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                    <span class="text-sm text-gray-700"><strong>Mobile friendly :</strong> Testez sur mobile avant
                        d'envoyer</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                    <span class="text-sm text-gray-700"><strong>Lien de désabonnement :</strong> N'oubliez pas d'inclure
                        {{ '{unsubscribe_url}' }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sendImmediately = document.getElementById('send_immediately');
        const scheduleField = document.getElementById('scheduleField');
        const scheduledAt = document.getElementById('scheduled_at');

        if (sendImmediately && scheduleField) {
            sendImmediately.addEventListener('change', function() {
                if (this.checked) {
                    scheduleField.style.display = 'none';
                    if (scheduledAt) {
                        scheduledAt.value = '';
                    }
                } else {
                    scheduleField.style.display = 'block';
                }
            });
        }

        // Initialiser un éditeur de texte simple (optionnel)
        const contentTextarea = document.getElementById('content');
        if (contentTextarea) {
            // Vous pouvez ajouter un éditeur WYSIWYG ici si nécessaire
            // Par exemple: CKEditor, TinyMCE, etc.
        }
    });
</script>
@endpush
