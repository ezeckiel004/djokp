@extends('layouts.admin')

@section('title', 'Détails accès E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.elearning.acces') }}" class="text-blue-600 hover:text-blue-800">
            <i class="mr-2 fas fa-arrow-left"></i> Retour aux accès
        </a>
    </div>

    <!-- Header -->
    <div class="p-6 mb-8 bg-white border border-gray-200 shadow-sm rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $acces->prenom }} {{ $acces->nom }}</h1>
                <div class="flex items-center mt-2 space-x-4">
                    <div class="text-gray-600">{{ $acces->email }}</div>
                    @if($acces->telephone)
                    <div class="text-gray-600">{{ $acces->telephone }}</div>
                    @endif
                    <div class="px-3 py-1 text-sm font-semibold rounded-full {{
                        $acces->status === 'active' ? 'bg-green-100 text-green-800' :
                        ($acces->status === 'expired' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                    }}">
                        {{ $acces->status === 'active' ? 'Actif' : ($acces->status === 'expired' ? 'Expiré' :
                        'Suspendu') }}
                    </div>
                </div>
            </div>

            <div class="flex space-x-3">
                @if($acces->status === 'active')
                <form action="{{ route('admin.elearning.acces.suspend', $acces->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-yellow-800 bg-yellow-100 rounded-lg hover:bg-yellow-200"
                        onclick="return confirm('Suspendre cet accès ?')">
                        <i class="mr-2 fas fa-pause"></i>
                        Suspendre
                    </button>
                </form>
                @elseif($acces->status === 'suspended')
                <form action="{{ route('admin.elearning.acces.activate', $acces->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-green-800 bg-green-100 rounded-lg hover:bg-green-200">
                        <i class="mr-2 fas fa-play"></i>
                        Activer
                    </button>
                </form>
                @endif

                <!-- Bouton Supprimer -->
                <form action="{{ route('admin.elearning.acces.destroy', $acces->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-red-800 bg-red-100 rounded-lg hover:bg-red-200"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet accès ? Cette action est irréversible.')">
                        <i class="mr-2 fas fa-trash"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Infos générales -->
        <div class="lg:col-span-2">
            <div class="mb-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informations d'accès</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Codes d'accès</h3>
                            <div class="space-y-2">
                                <div>
                                    <div class="text-xs text-gray-500">Code principal</div>
                                    <div class="p-2 font-mono bg-gray-100 rounded">{{ $acces->access_code }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Salle virtuelle</div>
                                    <div class="p-2 font-mono bg-gray-100 rounded">{{ $acces->virtual_room_code }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500">Forfait</h3>
                            <div class="space-y-2">
                                <div>
                                    <div class="text-sm font-medium">{{ $acces->forfait->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $acces->forfait->duration_days }} jours</div>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Prix payé</div>
                                    <div class="text-sm font-medium">
                                        {{ $acces->paiement ? number_format($acces->paiement->amount, 0, ',', ' ') . '
                                        €' : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="pt-6 mt-6 border-t border-gray-200">
                        <h3 class="mb-4 text-sm font-medium text-gray-500">Dates</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <div class="text-xs text-gray-500">Date début</div>
                                <div class="text-sm font-medium">{{ $acces->access_start->format('d/m/Y H:i') }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Date fin</div>
                                <div class="text-sm font-medium {{ $acces->access_end < now() ? 'text-red-600' : '' }}">
                                    {{ $acces->access_end->format('d/m/Y H:i') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $acces->access_end->diffForHumans() }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Dernière connexion</div>
                                <div class="text-sm font-medium">
                                    {{ $acces->last_access_at ? $acces->last_access_at->format('d/m/Y H:i') : 'Jamais'
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progression -->
            <div class="bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Progression</h2>
                </div>
                <div class="p-6">
                    <!-- Statistiques -->
                    <div class="grid grid-cols-2 gap-4 mb-6 md:grid-cols-4">
                        <div class="p-4 text-center rounded-lg bg-blue-50">
                            <div class="text-2xl font-bold text-blue-600">{{ $acces->cours_completed }}/{{
                                $acces->total_cours }}</div>
                            <div class="text-sm text-gray-600">Cours terminés</div>
                        </div>
                        <div class="p-4 text-center rounded-lg bg-green-50">
                            <div class="text-2xl font-bold text-green-600">{{
                                number_format($acces->progression_percentage, 1) }}%</div>
                            <div class="text-sm text-gray-600">Progression</div>
                        </div>
                        <div class="p-4 text-center rounded-lg bg-yellow-50">
                            <div class="text-2xl font-bold text-yellow-600">{{ number_format($acces->average_qcm_score
                                ?? 0, 1) }}%</div>
                            <div class="text-sm text-gray-600">Score moyen</div>
                        </div>
                        <div class="p-4 text-center rounded-lg bg-purple-50">
                            <div class="text-2xl font-bold text-purple-600">
                                @if($acces->access_end > now())
                                {{ $acces->access_end->diffInDays(now()) }}
                                @else
                                0
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Jours restants</div>
                        </div>
                    </div>

                    <!-- Liste des cours -->
                    <h3 class="mb-4 text-sm font-medium text-gray-500">Détail par cours</h3>
                    @if($progressions->count() > 0)
                    <div class="space-y-3">
                        @foreach($progressions as $progression)
                        <div class="p-4 transition-colors border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $progression->cours->title ?? 'Cours non
                                        défini' }}</h4>
                                    @if($progression->cours)
                                    <div class="text-xs text-gray-500">{{ $progression->cours->duration_formatted ??
                                        'Durée non définie' }}</div>
                                    @endif
                                </div>

                                <div class="flex space-x-2">
                                    @if($progression->cours_completed)
                                    <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full">
                                        <i class="mr-1 fas fa-check"></i> Terminé
                                    </span>
                                    @else
                                    <span class="px-2 py-1 text-xs text-gray-800 bg-gray-100 rounded-full">
                                        En cours
                                    </span>
                                    @endif

                                    @if($progression->qcm_completed && $progression->qcm)
                                    <span class="px-2 py-1 text-xs {{
                                        $progression->qcm_score >= ($progression->qcm->passing_score ?? 70) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                    }} rounded-full">
                                        QCM: {{ $progression->qcm_score ?? 0 }}%
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center text-xs text-gray-500">
                                <div class="mr-4">
                                    <i class="mr-1 fas fa-calendar"></i>
                                    {{ $progression->cours_completed_at ?
                                    $progression->cours_completed_at->format('d/m/Y') : 'Non terminé' }}
                                </div>
                                @if($progression->qcm_completed)
                                <div class="mr-4">
                                    <i class="mr-1 fas fa-history"></i>
                                    {{ $progression->qcm_attempts ?? 0 }} tentative(s)
                                </div>
                                <div>
                                    <i class="mr-1 fas fa-clock"></i>
                                    {{ $progression->qcm_completed_at ? $progression->qcm_completed_at->format('d/m/Y
                                    H:i') : 'Date inconnue' }}
                                </div>
                                @endif
                            </div>

                            <!-- Bouton pour voir les détails du QCM -->
                            @if($progression->qcm_completed && $progression->qcm)
                            <div class="pt-3 mt-3 border-t border-gray-100">
                                <a href="{{ route('admin.elearning.acces.qcm-details', ['acces' => $acces->id, 'qcm' => $progression->qcm_id]) }}"
                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                    <i class="mr-2 fas fa-eye"></i>
                                    Voir les réponses détaillées du QCM
                                </a>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="py-6 text-center">
                        <i class="mb-3 text-3xl text-gray-300 fas fa-book-open"></i>
                        <p class="text-gray-500">Aucune progression enregistrée pour cet accès.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Détails des QCM complétés -->
            @if(count($qcmsDetails) > 0)
            <div class="mt-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Résultats des QCM</h2>
                    <p class="text-sm text-gray-500">Détails des réponses pour chaque QCM complété</p>
                </div>
                <div class="p-6">
                    @foreach($qcmsDetails as $qcmId => $detail)
                    <div class="p-4 mb-4 border border-gray-200 rounded-lg">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $detail['progression']->qcm->title ?? 'QCM non
                                    défini' }}</h3>
                                @if(isset($detail['progression']->qcm) && $detail['progression']->qcm->is_examen_blanc)
                                <span
                                    class="inline-block px-2 py-1 mt-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                    Examen blanc
                                </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <div
                                    class="text-xl font-bold {{ ($detail['stats']['passed'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $detail['stats']['score'] ?? 0 }}%
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $detail['stats']['attempt_number'] ?? 0 }} tentative(s)
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques rapides -->
                        <div class="grid grid-cols-4 gap-2 mb-4">
                            <div class="p-2 text-center rounded bg-gray-50">
                                <div class="font-bold">{{ $detail['stats']['total_questions'] ?? 0 }}</div>
                                <div class="text-xs text-gray-600">Questions</div>
                            </div>

                            @php
                            $correctCount = isset($detail['questions']) ? count(array_filter($detail['questions'],
                            fn($q) => $q['is_correct'] ?? false)) : 0;
                            $incorrectCount = ($detail['stats']['total_questions'] ?? 0) - $correctCount;
                            @endphp

                            <div class="p-2 text-center rounded bg-green-50">
                                <div class="font-bold text-green-600">{{ $correctCount }}</div>
                                <div class="text-xs text-gray-600">Correctes</div>
                            </div>

                            <div class="p-2 text-center rounded bg-red-50">
                                <div class="font-bold text-red-600">{{ $incorrectCount }}</div>
                                <div class="text-xs text-gray-600">Incorrectes</div>
                            </div>

                            <div
                                class="text-center p-2 {{ ($detail['stats']['passed'] ?? false) ? 'bg-green-50' : 'bg-red-50' }} rounded">
                                <div
                                    class="font-bold {{ ($detail['stats']['passed'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ($detail['stats']['passed'] ?? false) ? 'Réussi' : 'Échoué' }}
                                </div>
                                <div class="text-xs text-gray-600">Résultat</div>
                            </div>
                        </div>

                        <!-- Aperçu des questions -->
                        @if(isset($detail['questions']) && count($detail['questions']) > 0)
                        <div class="pr-2 space-y-2 overflow-y-auto max-h-60">
                            @foreach(array_slice($detail['questions'], 0, 3) as $question)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    @if($question['is_correct'] ?? false)
                                    <i class="text-green-500 fas fa-check-circle"></i>
                                    @else
                                    <i class="text-red-500 fas fa-times-circle"></i>
                                    @endif
                                </div>
                                <div class="ml-2">
                                    <div class="text-sm font-medium">{{ Str::limit($question['question'] ?? 'Question
                                        sans texte', 50) }}</div>
                                    <div class="text-xs text-gray-500">
                                        Réponse:
                                        @if(is_array($question['user_answer'] ?? null))
                                        {{ implode(', ', $question['user_answer']) }}
                                        @else
                                        {{ $question['user_answer'] ?? 'Non répondue' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <a href="{{ route('admin.elearning.acces.qcm-details', ['acces' => $acces->id, 'qcm' => $qcmId]) }}"
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                <i class="mr-2 fas fa-chart-bar"></i>
                                Voir toutes les réponses et statistiques détaillées
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Session actuelle -->
            @if($acces->hasActiveSession())
            <div class="p-6 mb-6 border border-yellow-200 bg-yellow-50 rounded-xl">
                <h3 class="mb-4 text-lg font-semibold text-yellow-900">Session active</h3>
                <div class="space-y-3">
                    <div>
                        <div class="text-xs text-yellow-700">Connecté depuis</div>
                        <div class="text-sm font-medium">{{ $acces->current_session_start->format('H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-yellow-700">Adresse IP</div>
                        <div class="text-sm font-medium">{{ $acces->current_session_ip }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-yellow-700">Navigateur</div>
                        <div class="text-sm font-medium truncate">{{ Str::limit($acces->current_session_browser, 30) }}
                        </div>
                    </div>
                    <form action="{{ route('admin.elearning.sessions.force-logout', $acces->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 mt-4 text-red-800 bg-red-100 rounded-lg hover:bg-red-200">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            Forcer la déconnexion
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Certification -->
            <div class="p-6 mb-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Certification</h3>

                @if($acces->certification_file_path)
                <div class="mb-4">
                    <div class="mb-2 text-sm text-gray-600">Certification déjà envoyée</div>
                    <a href="{{ Storage::url($acces->certification_file_path) }}" target="_blank"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <i class="mr-2 fas fa-file-pdf"></i>
                        Télécharger le certificat
                    </a>
                    <div class="mt-1 text-xs text-gray-500">
                        Envoyé le {{ $acces->certification_sent_at ? $acces->certification_sent_at->format('d/m/Y') :
                        'Date inconnue' }}
                    </div>
                </div>
                @endif

                <form action="{{ route('admin.elearning.acces.upload-certification', $acces->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Uploader une certification
                        </label>
                        <input type="file" name="certification_file" accept=".pdf"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-gray-500">Format PDF uniquement (max 5MB)</p>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        <i class="mr-2 fas fa-upload"></i>
                        Uploader et envoyer
                    </button>
                </form>
            </div>

            <!-- Historique sessions -->
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Dernières connexions</h3>
                <div class="space-y-3">
                    @foreach($acces->sessions()->orderBy('login_at', 'desc')->limit(5)->get() as $session)
                    <div class="pl-3 border-l-4 border-blue-500">
                        <div class="text-sm font-medium">{{ $session->login_at->format('d/m H:i') }}</div>
                        <div class="text-xs text-gray-500">{{ $session->ip_address }}</div>
                        @if($session->logout_at)
                        <div class="text-xs text-gray-500">Durée:
                            @php
                            $start = \Carbon\Carbon::parse($session->login_at);
                            $end = \Carbon\Carbon::parse($session->logout_at);
                            $duration = $start->diff($end);

                            $durationString = '';
                            if ($duration->h > 0) {
                            $durationString .= $duration->h . 'h ';
                            }
                            if ($duration->i > 0) {
                            $durationString .= $duration->i . 'min ';
                            }
                            if ($duration->s > 0 && $duration->h == 0) {
                            $durationString .= $duration->s . 's';
                            }
                            echo trim($durationString);
                            @endphp
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
